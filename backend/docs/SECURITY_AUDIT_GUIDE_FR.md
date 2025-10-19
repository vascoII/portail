# 🛡️ Guide d'Audit de Sécurité pour Backend Clean Architecture

## Vue d'ensemble

L'audit de sécurité est une partie critique de la maintenance d'une codebase sécurisée. Ce guide couvre comment utiliser les outils d'audit de sécurité pour identifier les vulnérabilités dans vos dépendances et votre code, assurant que votre backend clean architecture reste sécurisé.

## 📋 Table des matières

1. [Qu'est-ce que l'Audit de Sécurité ?](#quest-ce-que-laudit-de-sécurité)
2. [Sécurité vs Code Propre](#sécurité-vs-code-propre)
3. [Vue d'ensemble des Outils](#vue-densemble-des-outils)
4. [Audit de Sécurité des Dépendances](#audit-de-sécurité-des-dépendances)
5. [Analyse de Sécurité du Code](#analyse-de-sécurité-du-code)
6. [Intégration avec CI/CD](#intégration-avec-cicd)
7. [Bonnes Pratiques](#bonnes-pratiques)
8. [Dépannage](#dépannage)
9. [Sécurité Avancée](#sécurité-avancée)

## Qu'est-ce que l'Audit de Sécurité ?

L'audit de sécurité implique :

- **Scanner les dépendances** pour les vulnérabilités connues (CVE)
- **Analyser le code** pour les anti-patterns de sécurité
- **Vérifier les configurations** pour les mauvaises configurations de sécurité
- **Surveiller** les nouvelles menaces de sécurité
- **Maintenir** un cycle de développement sécurisé

## Sécurité vs Code Propre

| Aspect        | Audit de Sécurité                                        | Outils de Code Propre                         |
| ------------- | -------------------------------------------------------- | --------------------------------------------- |
| **Objectif**  | Trouver les vulnérabilités & menaces                     | Améliorer la qualité & maintenabilité du code |
| **Focus**     | Risques de sécurité, CVE, exploits                       | Style, cohérence, sécurité des types          |
| **Outils**    | Scanners de sécurité, bases de données de vulnérabilités | Linters, formateurs, analyseurs statiques     |
| **Priorité**  | Critique (brèches de sécurité)                           | Important (qualité du code)                   |
| **Fréquence** | Quotidien/continu                                        | Pre-commit/CI                                 |

### Chaîne d'Outils de Développement Complète

```bash
# 1. Audit de Sécurité (Dépendances)
composer run security:check

# 2. Formatage du Code (Style)
composer run cs-fix

# 3. Analyse Statique (Types & Logique)
composer run phpstan

# 4. Tests (Fonctionnalité)
composer run test
```

## Vue d'ensemble des Outils

### 1. **Outils de Sécurité des Dépendances**

- **`composer audit`** - Sécurité Composer intégrée (Composer 2.4+)
- **`security-checker`** - Vérificateur de Sécurité Symfony
- **`snyk`** - Plateforme de sécurité commerciale
- **`github/dependabot`** - Mises à jour automatisées des dépendances

### 2. **Outils de Sécurité du Code**

- **`phpcs-security-audit`** - Règles de sécurité PHP CodeSniffer
- **`psalm`** - Analyse statique avec focus sécurité
- **`phpstan-security-rules`** - Extensions de sécurité PHPStan
- **`roave/security-advisories`** - Contraintes de sécurité Composer

### 3. **Sécurité Infrastructure**

- **`docker scout`** - Scan de vulnérabilités des conteneurs
- **`trivy`** - Scan de conteneurs et système de fichiers
- **`bandit`** - Linter de sécurité Python (si utilisation d'outils Python)

## Audit de Sécurité des Dépendances

### Utilisation du Security Checker

#### Commandes de Base

```bash
# Vérifier toutes les dépendances pour les vulnérabilités
composer run security:check

# Sortie JSON pour CI/CD
composer run security:check:json

# Sortie colorée ANSI
composer run security:check:ansi

# Format tableau
composer run security:check:table
```

#### Commandes Avancées

```bash
# Vérifier un fichier lock spécifique
./vendor/bin/security-checker security:check composer.lock

# Vérifier avec un format personnalisé
./vendor/bin/security-checker security:check --format=json

# Vérifier avec code de sortie sur vulnérabilités
./vendor/bin/security-checker security:check --exit-code

# Sortie verbeuse
./vendor/bin/security-checker security:check --verbose
```

### Comprendre la Sortie du Security Checker

#### ✅ **Aucune Vulnérabilité Trouvée**

```bash
$ composer run security:check
[OK] 0 packages ont des vulnérabilités connues
```

#### ⚠️ **Vulnérabilités Trouvées**

```bash
$ composer run security:check
[WARNING] 2 packages ont des vulnérabilités connues

symfony/http-foundation (v5.4.0)
  CVE-2022-24894: Vulnérabilité de fixation de session
  Plus d'info : https://symfony.com/cve-2022-24894

monolog/monolog (v2.8.0)
  CVE-2022-21724: Exécution de code à distance
  Plus d'info : https://github.com/advisories/GHSA-2q2h-3535-4p6h
```

#### Sortie JSON (pour CI/CD)

```json
{
  "advisories": {
    "symfony/http-foundation": [
      {
        "title": "Vulnérabilité de fixation de session",
        "link": "https://symfony.com/cve-2022-24894",
        "cve": "CVE-2022-24894"
      }
    ]
  }
}
```

### Utilisation de Composer Audit (Composer 2.4+)

Si vous mettez à jour vers Composer 2.4+, vous pouvez utiliser la commande audit intégrée :

```bash
# Vérifier les vulnérabilités
composer audit

# Vérifier avec un format spécifique
composer audit --format=json

# Vérifier avec code de sortie sur vulnérabilités
composer audit --audit-format=table
```

## Analyse de Sécurité du Code

### PHP Security CodeSniffer

Installer et configurer PHPCS avec les règles de sécurité :

```bash
# Installer PHPCS avec les règles de sécurité
composer require --dev phpcs-security-audit/phpcs-security-audit

# Exécuter l'analyse de sécurité
./vendor/bin/phpcs --standard=Security --extensions=php src/
```

### Exemples de Règles de Sécurité

#### 1. **Prévention des Injections SQL**

```php
// ❌ Vulnérable
$query = "SELECT * FROM users WHERE id = " . $_GET['id'];

// ✅ Sécurisé
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_GET['id']]);
```

#### 2. **Prévention XSS**

```php
// ❌ Vulnérable
echo $_GET['name'];

// ✅ Sécurisé
echo htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');
```

#### 3. **Sécurité des Uploads de Fichiers**

```php
// ❌ Vulnérable
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);

// ✅ Sécurisé
$allowedTypes = ['image/jpeg', 'image/png'];
$maxSize = 2 * 1024 * 1024; // 2MB

if (in_array($_FILES['file']['type'], $allowedTypes) &&
    $_FILES['file']['size'] <= $maxSize) {
    $filename = uniqid() . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $filename);
}
```

### Règles de Sécurité Personnalisées

Créer des règles de sécurité personnalisées pour votre clean architecture :

```xml
<!-- phpcs.xml -->
<?xml version="1.0"?>
<ruleset name="Règles de Sécurité">
    <description>Règles de sécurité personnalisées pour clean architecture</description>

    <!-- Inclure les règles de sécurité -->
    <rule ref="Security"/>

    <!-- Règles personnalisées pour notre architecture -->
    <rule ref="Generic.PHP.ForbiddenFunctions">
        <properties>
            <property name="forbiddenFunctions" type="array">
                <element key="eval" value="null"/>
                <element key="exec" value="null"/>
                <element key="system" value="null"/>
                <element key="shell_exec" value="null"/>
                <element key="passthru" value="null"/>
            </property>
        </properties>
    </rule>

    <!-- Vérifier les requêtes de base de données directes dans la couche Application -->
    <rule ref="Generic.Files.LineLength">
        <properties>
            <property name="lineLimit" value="120"/>
            <property name="absoluteLineLimit" value="150"/>
        </properties>
    </rule>
</ruleset>
```

## Intégration avec CI/CD

### Workflow de Sécurité GitHub Actions

```yaml
# .github/workflows/security.yml
name: Audit de Sécurité

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main]
  schedule:
    - cron: "0 2 * * *" # Quotidien à 2h du matin

jobs:
  security-audit:
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

      - name: Vérification de Sécurité
        run: composer run security:check

      - name: Vérification de Sécurité JSON (pour rapport)
        run: composer run security:check:json > security-report.json

      - name: Upload rapport de sécurité
        uses: actions/upload-artifact@v3
        with:
          name: security-report
          path: security-report.json
```

### Pipeline de Sécurité GitLab CI

```yaml
# .gitlab-ci.yml
security-audit:
  stage: security
  image: php:8.2-cli
  before_script:
    - composer install --prefer-dist --no-progress
  script:
    - composer run security:check
  artifacts:
    reports:
      junit: security-report.json
  only:
    - merge_requests
    - main
```

### Pipeline de Sécurité Jenkins

```groovy
pipeline {
    agent any

    stages {
        stage('Audit de Sécurité') {
            steps {
                sh 'composer install --prefer-dist --no-progress'
                sh 'composer run security:check'
            }
        }

        stage('Rapport de Sécurité') {
            steps {
                sh 'composer run security:check:json > security-report.json'
                archiveArtifacts artifacts: 'security-report.json'
            }
        }
    }
}
```

## Bonnes Pratiques

### 1. **Vérifications de Sécurité Quotidiennes**

```bash
# Ajouter à votre routine quotidienne
composer run security:check
composer run cs-fix:check
composer run phpstan
```

### 2. **Mises à Jour Automatisées des Dépendances**

```json
// composer.json
{
  "config": {
    "allow-plugins": {
      "symfony/flex": true
    },
    "sort-packages": true,
    "allow-plugins": {
      "symfony/flex": true
    }
  },
  "scripts": {
    "post-update-cmd": ["@auto-scripts", "composer run security:check"]
  }
}
```

### 3. **Développement Sécurisé en Premier**

```php
// Toujours valider les entrées
class LoginInputDto
{
    public function __construct(
        public readonly string $username,
        public readonly string $password
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->username) || empty($this->password)) {
            throw new ValidationException('Le nom d\'utilisateur et le mot de passe sont requis');
        }

        if (strlen($this->username) > 255) {
            throw new ValidationException('Nom d\'utilisateur trop long');
        }
    }
}
```

### 4. **Configuration Sécurisée**

```yaml
# config/packages/security.yaml
security:
  password_hashers:
    App\Domain\Entity\User:
      algorithm: auto
      cost: 12

  providers:
    app_user_provider:
      entity:
        class: App\Domain\Entity\User
        property: email

  firewalls:
    main:
      provider: app_user_provider
      form_login:
        login_path: login
        check_path: login
      logout:
        path: logout
      remember_me:
        secret: "%kernel.secret%"
        lifetime: 604800 # 1 semaine
```

### 5. **Sécurité Spécifique à l'Environnement**

```bash
# .env.local (jamais commiter)
APP_ENV=prod
APP_SECRET=your-super-secret-key-here
DATABASE_URL="mysql://user:password@localhost:3306/database"
REDIS_URL="redis://localhost:6379"

# .env (valeurs par défaut sûres)
APP_ENV=dev
APP_SECRET=dev-secret-key
DATABASE_URL="mysql://root:@localhost:3306/portail_dev"
REDIS_URL="redis://localhost:6379"
```

## Dépannage

### Problèmes de Sécurité Courants

#### 1. **Dépendances Obsolètes**

```bash
# Vérifier les packages obsolètes
composer outdated

# Mettre à jour un package spécifique
composer update symfony/http-foundation

# Mettre à jour tous les packages (attention !)
composer update
```

#### 2. **Faux Positifs de Vulnérabilité**

```bash
# Vérifier un package spécifique
./vendor/bin/security-checker security:check symfony/http-foundation

# Vérifier avec sortie verbeuse
./vendor/bin/security-checker security:check --verbose
```

#### 3. **Problèmes de Mémoire**

```bash
# Augmenter la limite de mémoire
php -d memory_limit=2G ./vendor/bin/security-checker security:check
```

#### 4. **Problèmes de Réseau**

```bash
# Vérifier avec timeout
./vendor/bin/security-checker security:check --timeout=30

# Vérifier hors ligne (si vous avez des données en cache)
./vendor/bin/security-checker security:check --no-ansi
```

### Configuration du Security Checker

Créer un fichier de configuration pour des paramètres personnalisés :

```yaml
# security-checker.yaml
security_checker:
  timeout: 30
  format: table
  exit_code: true
  cache_dir: var/cache/security
```

## Sécurité Avancée

### 1. **Règles de Sécurité Personnalisées**

Créer des règles de sécurité personnalisées pour votre clean architecture :

```php
// src/Security/CustomSecurityRule.php
class CustomSecurityRule implements \PhpCsFixer\Fixer\FixerInterface
{
    public function getName(): string
    {
        return 'custom_security_rule';
    }

    public function isCandidate(\PhpCsFixer\Tokenizer\Tokens $tokens): bool
    {
        return $tokens->isTokenKindFound(T_STRING);
    }

    public function isRisky(): bool
    {
        return true; // Les règles de sécurité sont risquées
    }

    public function fix(\SplFileInfo $file, \PhpCsFixer\Tokenizer\Tokens $tokens): void
    {
        // Logique de sécurité personnalisée
        for ($index = 0; $index < $tokens->count(); ++$index) {
            $token = $tokens[$index];

            if ($token->isGivenKind(T_STRING) && $token->getContent() === 'eval') {
                throw new \RuntimeException('La fonction eval() n\'est pas autorisée pour des raisons de sécurité');
            }
        }
    }

    public function getDefinition(): \PhpCsFixer\FixerDefinition\FixerDefinitionInterface
    {
        return new \PhpCsFixer\FixerDefinition\FixerDefinition(
            'Règle de sécurité personnalisée pour empêcher les fonctions dangereuses',
            []
        );
    }

    public function getPriority(): int
    {
        return 0;
    }

    public function supports(\SplFileInfo $file): bool
    {
        return true;
    }
}
```

### 2. **Surveillance de Sécurité**

Configurer une surveillance de sécurité continue :

```bash
# Script de vérification de sécurité quotidien
#!/bin/bash
# scripts/daily-security-check.sh

echo "🔍 Exécution de l'audit de sécurité quotidien..."

# Vérifier les dépendances
composer run security:check

# Vérifier la sécurité du code
./vendor/bin/phpcs --standard=Security src/

# Générer un rapport
composer run security:check:json > reports/security-$(date +%Y%m%d).json

echo "✅ Audit de sécurité terminé"
```

### 3. **Alertes de Sécurité**

Configurer des alertes pour les nouvelles vulnérabilités :

```yaml
# .github/workflows/security-alerts.yml
name: Alertes de Sécurité

on:
  schedule:
    - cron: "0 9 * * *" # Quotidien à 9h du matin
  workflow_dispatch:

jobs:
  security-alerts:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v3

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: "8.2"

      - name: Install dependencies
        run: composer install --prefer-dist --no-progress

      - name: Vérification de Sécurité
        run: composer run security:check

      - name: Créer Issue sur Vulnérabilité
        if: failure()
        uses: actions/github-script@v6
        with:
          script: |
            github.rest.issues.create({
              owner: context.repo.owner,
              repo: context.repo.repo,
              title: '🚨 Vulnérabilité de Sécurité Détectée',
              body: 'Une vulnérabilité de sécurité a été détectée dans les dépendances. Veuillez examiner et mettre à jour.',
              labels: ['security', 'urgent']
            })
```

## Sécurité Spécifique au Projet

### Pour Notre Clean Architecture

```bash
# Workflow d'audit de sécurité complet
composer run security:check && \
composer run cs-fix:check && \
composer run phpstan && \
echo "✅ Toutes les vérifications de sécurité et de qualité ont réussi"
```

### Checklist de Sécurité

- [ ] **Dépendances** : Aucune vulnérabilité connue
- [ ] **Validation des Entrées** : Toutes les entrées validées et sanitizées
- [ ] **Authentification** : Hachage sécurisé des mots de passe et gestion des sessions
- [ ] **Autorisation** : Contrôle d'accès et permissions appropriés
- [ ] **Protection des Données** : Données sensibles chiffrées et protégées
- [ ] **Gestion des Erreurs** : Aucune information sensible dans les messages d'erreur
- [ ] **Logging** : Événements de sécurité correctement loggés
- [ ] **Configuration** : Configurations par défaut sécurisées
- [ ] **Dépendances** : Mises à jour et surveillance régulières
- [ ] **Code Review** : Reviews de code axées sur la sécurité

## Référence Rapide

### Commandes Essentielles

```bash
# Audit de sécurité
composer run security:check

# Sécurité avec sortie JSON
composer run security:check:json

# Formatage du code
composer run cs-fix

# Analyse statique
composer run phpstan

# Audit complet
composer run security:check && composer run cs-fix:check && composer run phpstan
```

### Intégration des Outils de Sécurité

```bash
# 1. Vérification de Sécurité (Dépendances)
composer run security:check

# 2. Formatage du Code (Style)
composer run cs-fix

# 3. Analyse Statique (Types)
composer run phpstan

# 4. Analyse de Sécurité du Code
./vendor/bin/phpcs --standard=Security src/
```

### Codes de Sortie

- **0** : Aucune vulnérabilité trouvée
- **1** : Vulnérabilités trouvées
- **2** : Erreur survenue

---

## 🚀 Commencer

1. **Installer les outils de sécurité** : `composer require --dev enlightn/security-checker`
2. **Exécuter la vérification de sécurité** : `composer run security:check`
3. **Intégrer avec CI/CD** : Ajouter les vérifications de sécurité à votre pipeline
4. **Configurer la surveillance** : Configurer des audits de sécurité quotidiens
5. **Examiner et mettre à jour** : Vérifier régulièrement les nouvelles vulnérabilités

L'audit de sécurité est essentiel pour maintenir un backend clean architecture sécurisé et fiable ! 🛡️✨
