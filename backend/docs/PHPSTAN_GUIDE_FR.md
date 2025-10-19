# 🔍 Guide PHPStan pour Backend Clean Architecture

## Vue d'ensemble

PHPStan est un outil d'analyse statique pour PHP qui aide à détecter les bugs avant qu'ils n'atteignent la production. Ce guide explique comment utiliser PHPStan efficacement dans notre projet backend clean architecture.

## 📋 Table des matières

1. [Qu'est-ce que PHPStan ?](#quest-ce-que-phpstan)
2. [Installation & Configuration](#installation--configuration)
3. [Configuration](#configuration)
4. [Exécution de PHPStan](#exécution-de-phpstan)
5. [Comprendre les Résultats](#comprendre-les-résultats)
6. [Intégration avec CI/CD](#intégration-avec-cicd)
7. [Bonnes Pratiques](#bonnes-pratiques)
8. [Dépannage](#dépannage)
9. [Utilisation Avancée](#utilisation-avancée)

## Qu'est-ce que PHPStan ?

PHPStan est un outil d'analyse statique qui :

- **Trouve les bugs** sans exécuter le code
- **Analyse les types** et détecte les erreurs liées aux types
- **Détecte le code mort** et les variables inutilisées
- **Valide les appels de méthodes** et l'accès aux propriétés
- **Vérifie les types de retour** et les types de paramètres
- **Assure la qualité du code** et la cohérence

## Installation & Configuration

### Prérequis

- PHP 8.1 ou supérieur
- Composer

### Installation

```bash
# Installer PHPStan
composer require --dev phpstan/phpstan

# Installer les règles spécifiques à Symfony (optionnel mais recommandé)
composer require --dev phpstan/phpstan-symfony

# Installer les règles Doctrine (si vous utilisez Doctrine)
composer require --dev phpstan/phpstan-doctrine
```

### Vérifier l'Installation

```bash
# Vérifier si PHPStan est installé
./vendor/bin/phpstan --version

# Sortie attendue : PHPStan - PHP Static Analysis Tool 1.x.x
```

## Configuration

### Configuration de Base (`phpstan.neon`)

```neon
parameters:
    level: 6
    paths:
        - src
    excludePaths:
        - src/Http
        - var
        - vendor
    ignoreErrors:
        # Ignorer les erreurs dans les fichiers générés
        - '#Call to an undefined method#'
        # Ignorer les erreurs du client SOAP (dépendance externe)
        - '#Call to an undefined method SoapClient#'
    checkMissingIterableValueType: false
    checkGenericClassInNonGenericObjectType: false
    reportUnmatchedIgnoredErrors: false
```

### Configuration Avancée

```neon
parameters:
    level: 8
    paths:
        - src
    excludePaths:
        - src/Http
        - var
        - vendor
        - tests

    # Inclure des règles supplémentaires
    includes:
        - vendor/phpstan/phpstan-symfony/extension.neon
        - vendor/phpstan/phpstan-doctrine/extension.neon

    # Ignorer des erreurs spécifiques
    ignoreErrors:
        - '#Call to an undefined method#'
        - '#Call to an undefined method SoapClient#'
        - '#Property .* has no type specified#'

    # Règles personnalisées
    checkMissingIterableValueType: false
    checkGenericClassInNonGenericObjectType: false
    reportUnmatchedIgnoredErrors: false

    # Limite de mémoire
    memoryLimitFile: 2G
```

## Exécution de PHPStan

### Commandes de Base

```bash
# Exécuter PHPStan sur toute la codebase
./vendor/bin/phpstan analyse

# Exécuter avec un niveau spécifique
./vendor/bin/phpstan analyse --level=6

# Exécuter sur un répertoire spécifique
./vendor/bin/phpstan analyse src/Application

# Exécuter sur un fichier spécifique
./vendor/bin/phpstan analyse src/Application/UseCase/Security/LoginUseCase.php

# Générer une baseline (ignorer les erreurs actuelles)
./vendor/bin/phpstan analyse --generate-baseline

# Utiliser un fichier baseline
./vendor/bin/phpstan analyse --baseline=phpstan-baseline.neon
```

### Commandes Avancées

```bash
# Exécuter avec une limite de mémoire
./vendor/bin/phpstan analyse --memory-limit=2G

# Exécuter avec traitement parallèle
./vendor/bin/phpstan analyse --parallel

# Générer un rapport JSON
./vendor/bin/phpstan analyse --error-format=json > phpstan-report.json

# Exécuter avec une configuration personnalisée
./vendor/bin/phpstan analyse -c phpstan.neon

# Sortie verbeuse
./vendor/bin/phpstan analyse --verbose
```

### Scripts Composer

Ajouter à `composer.json` :

```json
{
  "scripts": {
    "phpstan": "phpstan analyse",
    "phpstan:baseline": "phpstan analyse --generate-baseline",
    "phpstan:ci": "phpstan analyse --error-format=github"
  }
}
```

Puis exécuter :

```bash
composer run phpstan
composer run phpstan:baseline
composer run phpstan:ci
```

## Comprendre les Résultats

### Niveaux d'Erreur

PHPStan utilise les niveaux 0-9, où les niveaux plus élevés détectent plus de problèmes :

- **Niveau 0** : Vérifications de base (variables non définies, classes inconnues)
- **Niveau 1** : Méthodes inconnues, propriétés inconnues
- **Niveau 2** : Méthodes et propriétés magiques inconnues
- **Niveau 3** : Méthodes inconnues sur types mixtes
- **Niveau 4** : Méthodes inconnues sur types mixtes avec plus de vérifications
- **Niveau 5** : Méthodes inconnues sur types mixtes avec encore plus de vérifications
- **Niveau 6** : Méthodes inconnues sur types mixtes avec vérifications maximales
- **Niveau 7** : Méthodes inconnues sur types mixtes avec vérifications maximales + plus
- **Niveau 8** : Méthodes inconnues sur types mixtes avec vérifications maximales + encore plus
- **Niveau 9** : Strictesse maximale

### Types d'Erreurs Courants

#### 1. Variable Non Définie

```php
// Erreur : Variable non définie $name
function greet() {
    echo "Hello " . $name; // $name n'est pas défini
}
```

#### 2. Méthode Non Définie

```php
// Erreur : Appel à une méthode non définie
$user = new User();
$user->getFullName(); // La méthode n'existe pas
```

#### 3. Incompatibilité de Type

```php
// Erreur : Le paramètre #1 $id de la méthode attend int, string donné
function getUser(int $id): User {
    return new User($id);
}

getUser("123"); // String au lieu de int
```

#### 4. Problèmes de Type Nullable

```php
// Erreur : Impossible d'appeler une méthode sur un type nullable
function processUser(?User $user): string {
    return $user->getName(); // $user pourrait être null
}
```

#### 5. Problèmes d'Accès aux Tableaux

```php
// Erreur : Impossible d'accéder à l'offset sur un type mixte
function getValue(array $data): string {
    return $data['key']; // $data['key'] pourrait ne pas exister
}
```

### Lire les Messages d'Erreur

```
 ------ -------------------------------------------------------------------------
  Ligne   src/Application/UseCase/Security/LoginUseCase.php
 ------ -------------------------------------------------------------------------
  25     Appel à une méthode non définie App\Application\Service\DataProvider\SecurityDataProviderInterface::loginService().
 ------ -------------------------------------------------------------------------
```

**Traduction :**

- **Fichier** : `src/Application/UseCase/Security/LoginUseCase.php`
- **Ligne** : 25
- **Problème** : La méthode `loginService()` n'existe pas sur `SecurityDataProviderInterface`

## Intégration avec CI/CD

### GitHub Actions

```yaml
# .github/workflows/phpstan.yml
name: PHPStan

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main]

jobs:
  phpstan:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v3

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: "8.2"
          extensions: mbstring, xml, ctype, iconv, intl

      - name: Install dependencies
        run: composer install --prefer-dist --no-progress

      - name: Run PHPStan
        run: ./vendor/bin/phpstan analyse --error-format=github
```

### GitLab CI

```yaml
# .gitlab-ci.yml
phpstan:
  stage: test
  image: php:8.2-cli
  before_script:
    - composer install --prefer-dist --no-progress
  script:
    - ./vendor/bin/phpstan analyse --error-format=gitlab
  only:
    - merge_requests
    - main
```

### Jenkins Pipeline

```groovy
pipeline {
    agent any

    stages {
        stage('PHPStan') {
            steps {
                sh 'composer install --prefer-dist --no-progress'
                sh './vendor/bin/phpstan analyse --error-format=checkstyle > phpstan-report.xml'
                publishCheckstyle pattern: 'phpstan-report.xml'
            }
        }
    }
}
```

## Bonnes Pratiques

### 1. Commencer avec le Niveau 6

```bash
# Commencer avec le niveau 6 pour un bon équilibre
./vendor/bin/phpstan analyse --level=6
```

### 2. Utiliser les Baselines

```bash
# Générer une baseline pour ignorer les erreurs actuelles
./vendor/bin/phpstan analyse --generate-baseline

# Utiliser la baseline dans les exécutions futures
./vendor/bin/phpstan analyse --baseline=phpstan-baseline.neon
```

### 3. Se Concentrer sur les Problèmes Critiques en Premier

```bash
# Exécuter avec des types d'erreur spécifiques
./vendor/bin/phpstan analyse --error-format=table | grep "Call to an undefined method"
```

### 4. Exclure le Code Généré

```neon
parameters:
    excludePaths:
        - src/Http  # Contrôleurs générés
        - var       # Fichiers de cache
        - vendor    # Code tiers
```

### 5. Utiliser des Ignores Spécifiques

```neon
parameters:
    ignoreErrors:
        # Ignorer les problèmes spécifiques du client SOAP
        - '#Call to an undefined method SoapClient::__soapCall#'
        # Ignorer une ligne spécifique
        - '#Call to an undefined method#'
          path: src/Infrastructure/Service/DataSource/SecuritySoap.php
          count: 1
```

### 6. Ajouter des Indications de Type

```php
// Avant
function processUser($user) {
    return $user->getName();
}

// Après
function processUser(User $user): string {
    return $user->getName();
}
```

### 7. Utiliser PHPDoc

```php
/**
 * @param array<string, mixed> $data
 * @return array<string, string>
 */
function processData(array $data): array {
    // Implémentation
}
```

## Dépannage

### Problèmes Courants

#### 1. Limite de Mémoire

```bash
# Erreur : Fatal error: Allowed memory size exhausted
./vendor/bin/phpstan analyse --memory-limit=2G
```

#### 2. Analyse Lente

```bash
# Utiliser le traitement parallèle
./vendor/bin/phpstan analyse --parallel

# Ou réduire le niveau temporairement
./vendor/bin/phpstan analyse --level=4
```

#### 3. Faux Positifs

```neon
# Dans phpstan.neon
parameters:
    ignoreErrors:
        - '#Call to an undefined method#'
          path: src/Infrastructure/Service/DataSource/SecuritySoap.php
          count: 1
```

#### 4. Extensions Manquantes

```bash
# Installer les extensions manquantes
composer require --dev phpstan/phpstan-symfony
composer require --dev phpstan/phpstan-doctrine
```

### Mode Debug

```bash
# Exécuter avec des informations de debug
./vendor/bin/phpstan analyse --debug

# Afficher seulement les erreurs (pas les avertissements)
./vendor/bin/phpstan analyse --no-progress
```

## Utilisation Avancée

### Règles Personnalisées

```php
// Créer une règle personnalisée
class CustomRule implements \PHPStan\Rules\Rule
{
    public function getNodeType(): string
    {
        return \PhpParser\Node\Expr\MethodCall::class;
    }

    public function processNode(\PhpParser\Node $node, \PHPStan\Analyser\Scope $scope): array
    {
        // Logique personnalisée
        return [];
    }
}
```

### Configuration par Répertoire

```neon
parameters:
    paths:
        - src

    # Règles différentes pour différents répertoires
    rules:
        - PHPStan\Rules\Methods\CallToStaticMethodStaticallyRule
        - PHPStan\Rules\Functions\CallToNonExistentFunctionRule
```

### Intégration avec IDE

```json
// .vscode/settings.json
{
  "phpstan.enabled": true,
  "phpstan.configFile": "phpstan.neon",
  "phpstan.level": 6
}
```

### Formateurs d'Erreur Personnalisés

```php
// Créer un formateur personnalisé
class CustomFormatter implements \PHPStan\Command\ErrorFormatter\ErrorFormatter
{
    public function formatErrors(
        \PHPStan\Command\AnalysisResult $analysisResult,
        \Symfony\Component\Console\Style\OutputStyle $style
    ): int {
        // Logique de formatage personnalisée
        return 0;
    }
}
```

## Configuration Spécifique au Projet

### Pour Notre Clean Architecture

```neon
parameters:
    level: 6
    paths:
        - src
    excludePaths:
        - src/Http  # Les contrôleurs sont fins, se concentrer sur la logique métier
        - var
        - vendor

    # Se concentrer sur les couches Application et Infrastructure
    ignoreErrors:
        # Le client SOAP est une dépendance externe
        - '#Call to an undefined method SoapClient#'
        # Le conteneur Symfony est externe
        - '#Call to an undefined method Symfony\\Component\\DependencyInjection\\ContainerInterface#'

    # Vérifier les problèmes courants dans notre architecture
    checkMissingIterableValueType: false
    checkGenericClassInNonGenericObjectType: false
    reportUnmatchedIgnoredErrors: false
```

### Workflow Recommandé

1. **Commencer avec la baseline** : `./vendor/bin/phpstan analyse --generate-baseline`
2. **Corriger les problèmes critiques** : Se concentrer sur les méthodes non définies et les erreurs de type
3. **Augmenter progressivement le niveau** : Passer du niveau 6 au niveau 8 au fil du temps
4. **Intégrer avec CI** : Ajouter à GitHub Actions/GitLab CI
5. **Maintenance régulière** : Exécuter hebdomadairement et corriger les nouveaux problèmes

## Référence Rapide

### Commandes Essentielles

```bash
# Analyse de base
./vendor/bin/phpstan analyse

# Avec un niveau spécifique
./vendor/bin/phpstan analyse --level=6

# Générer une baseline
./vendor/bin/phpstan analyse --generate-baseline

# Utiliser la baseline
./vendor/bin/phpstan analyse --baseline=phpstan-baseline.neon

# Traitement parallèle
./vendor/bin/phpstan analyse --parallel

# Limite de mémoire
./vendor/bin/phpstan analyse --memory-limit=2G
```

### Niveaux de Configuration

- **Niveau 0-2** : Vérifications de base (commencer ici)
- **Niveau 3-4** : Bon équilibre pour la plupart des projets
- **Niveau 5-6** : Recommandé pour la production
- **Niveau 7-8** : Strict (utiliser progressivement)
- **Niveau 9** : Strictesse maximale (avancé)

### Patterns d'Erreur Courants

- `Call to an undefined method` → La méthode n'existe pas
- `Parameter #X expects Y, Z given` → Incompatibilité de type
- `Cannot call method on nullable type` → Problème de sécurité null
- `Cannot access offset on mixed type` → Problème d'accès au tableau
- `Property has no type specified` → Indication de type manquante

---

## 🚀 Commencer

1. **Installer PHPStan** : `composer require --dev phpstan/phpstan`
2. **Exécuter l'analyse de base** : `./vendor/bin/phpstan analyse`
3. **Générer une baseline** : `./vendor/bin/phpstan analyse --generate-baseline`
4. **Corriger les problèmes critiques** un par un
5. **Intégrer avec CI/CD** pour une qualité continue

PHPStan vous aidera à maintenir une qualité de code élevée et à détecter les bugs tôt dans votre backend clean architecture ! 🎯
