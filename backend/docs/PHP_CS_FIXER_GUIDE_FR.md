# 🎨 Guide PHP CS Fixer pour Backend Clean Architecture

## Vue d'ensemble

PHP CS Fixer est un outil pour corriger automatiquement le code PHP afin de suivre un standard de codage. Ce guide explique comment utiliser PHP CS Fixer efficacement dans notre projet backend clean architecture.

## 📋 Table des matières

1. [Qu'est-ce que PHP CS Fixer ?](#quest-ce-que-php-cs-fixer)
2. [Installation & Configuration](#installation--configuration)
3. [Configuration](#configuration)
4. [Exécution de PHP CS Fixer](#exécution-de-php-cs-fixer)
5. [Comprendre les Résultats](#comprendre-les-résultats)
6. [Intégration avec CI/CD](#intégration-avec-cicd)
7. [Bonnes Pratiques](#bonnes-pratiques)
8. [Dépannage](#dépannage)
9. [Utilisation Avancée](#utilisation-avancée)

## Qu'est-ce que PHP CS Fixer ?

PHP CS Fixer est un outil qui :

- **Corrige automatiquement** le code PHP pour suivre les standards de codage
- **Applique la cohérence** à travers votre codebase
- **Supporte plusieurs standards** (PSR-12, Symfony, etc.)
- **S'intègre avec les IDEs** et pipelines CI/CD
- **Améliore la lisibilité du code** et la maintenabilité
- **Réduit le temps de code review** en gérant le formatage automatiquement

## Installation & Configuration

### Prérequis

- PHP 8.2 ou supérieur
- Composer

### Installation

```bash
# Installer PHP CS Fixer
composer require --dev friendsofphp/php-cs-fixer

# Vérifier l'installation
./vendor/bin/php-cs-fixer --version
```

### Vérifier l'Installation

```bash
# Vérifier si PHP CS Fixer est installé
./vendor/bin/php-cs-fixer --version

# Sortie attendue : PHP CS Fixer 3.x.x Folding Bike by Fabien Potencier...
```

## Configuration

### Configuration de Base (`.php-cs-fixer.php`)

```php
<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude([
        'Http', // Exclure les contrôleurs car ils sont fins
        'var',
        'vendor',
    ])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@Symfony' => true,
        '@PhpCsFixer' => true,
        // ... règles supplémentaires
    ])
    ->setFinder($finder);

return $config;
```

### Configuration Avancée

```php
<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude(['Http', 'var', 'vendor'])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        // Règles de base
        '@PSR12' => true,
        '@Symfony' => true,
        '@PhpCsFixer' => true,

        // Règles de tableau
        'array_syntax' => ['syntax' => 'short'],
        'array_indentation' => true,
        'trim_array_spaces' => true,
        'whitespace_after_comma_in_array' => true,

        // Règles de classe
        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one',
                'property' => 'one',
                'trait_import' => 'none',
            ],
        ],
        'no_unused_imports' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['class', 'function', 'const'],
        ],

        // Règles de fonction
        'function_declaration' => [
            'closure_function_spacing' => 'one',
        ],
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],

        // Règles de chaîne
        'single_quote' => true,
        'concat_space' => ['spacing' => 'one'],
        'escape_implicit_backslashes' => true,

        // Règles de structure de contrôle
        'control_structure_braces' => true,
        'control_structure_continuation_position' => true,
        'elseif' => true,
        'no_alternative_syntax' => true,
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'switch_continue_to_break' => true,

        // Règles d'opérateur
        'binary_operator_spaces' => [
            'default' => 'single_space',
            'operators' => [
                '=>' => 'single_space',
                '=' => 'single_space',
                '==' => 'single_space',
                '===' => 'single_space',
                '!=' => 'single_space',
                '!==' => 'single_space',
                '<' => 'single_space',
                '>' => 'single_space',
                '<=' => 'single_space',
                '>=' => 'single_space',
                '&&' => 'single_space',
                '||' => 'single_space',
                '+' => 'single_space',
                '-' => 'single_space',
                '*' => 'single_space',
                '/' => 'single_space',
                '%' => 'single_space',
            ],
        ],
        'unary_operator_spaces' => true,
        'not_operator_with_successor_space' => true,
        'object_operator_without_whitespace' => true,

        // Règles de cast
        'cast_spaces' => true,
        'no_short_bool_cast' => true,

        // Règles de commentaire
        'single_line_comment_style' => [
            'comment_types' => ['hash'],
        ],
        'multiline_comment_opening_closing' => true,

        // Règles générales
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => [
            'statements' => ['return', 'throw', 'try'],
        ],
        'braces' => [
            'allow_single_line_closure' => true,
            'position_after_anonymous_constructs' => 'same',
            'position_after_control_structures' => 'same',
            'position_after_functions_and_oop_constructs' => 'next',
        ],
        'clean_namespace' => true,
        'declare_strict_types' => true,
        'encoding' => true,
        'full_opening_tag' => true,
        'indentation_type' => true,
        'line_ending' => true,
        'linebreak_after_opening_tag' => true,
        'constant_case' => ['case' => 'lower'],
        'lowercase_keywords' => true,
        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'method_chaining_indentation' => true,
        'native_function_casing' => true,
        'no_closing_tag' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'case',
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'switch',
                'throw',
                'use',
            ],
        ],
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'echo_tag_syntax' => ['format' => 'long'],
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_around_offset' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unneeded_curly_braces' => true,
        'no_unset_cast' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'object_operator_without_whitespace' => true,
        'ordered_class_elements' => [
            'order' => [
                'use_trait',
                'constant_public',
                'constant_protected',
                'constant_private',
                'property_public',
                'property_protected',
                'property_private',
                'construct',
                'destruct',
                'magic',
                'phpunit',
                'method_public',
                'method_protected',
                'method_private',
            ],
            'sort_algorithm' => 'alpha',
        ],
        'phpdoc_indent' => true,
        'phpdoc_inline_tag_normalizer' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_package' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_scalar' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_var_without_name' => true,
        'return_type_declaration' => true,
        'self_accessor' => true,
        'short_scalar_cast' => true,
        'single_blank_line_at_eof' => true,
        'single_class_element_per_statement' => true,
        'single_line_after_imports' => true,
        'single_line_comment_style' => [
            'comment_types' => ['hash'],
        ],
        'single_trait_insert_per_statement' => true,
        'space_after_semicolon' => true,
        'standardize_not_equals' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline' => true,
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'visibility_required' => true,
        'whitespace_after_comma_in_array' => true,
    ])
    ->setFinder($finder);

return $config;
```

## Exécution de PHP CS Fixer

### Commandes de Base

```bash
# Corriger tous les fichiers
./vendor/bin/php-cs-fixer fix

# Exécution à sec (montrer ce qui serait changé)
./vendor/bin/php-cs-fixer fix --dry-run --diff

# Corriger un fichier spécifique
./vendor/bin/php-cs-fixer fix src/Application/UseCase/Security/LoginUseCase.php

# Corriger un répertoire spécifique
./vendor/bin/php-cs-fixer fix src/Application/

# Sortie verbeuse
./vendor/bin/php-cs-fixer fix --verbose

# Afficher le progrès
./vendor/bin/php-cs-fixer fix --show-progress
```

### Commandes Avancées

```bash
# Utiliser une configuration personnalisée
./vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php

# Corriger avec des règles spécifiques
./vendor/bin/php-cs-fixer fix --rules=@PSR12

# Corriger avec plusieurs règles
./vendor/bin/php-cs-fixer fix --rules=@PSR12,@Symfony

# S'arrêter à la première violation
./vendor/bin/php-cs-fixer fix --stop-on-violation

# Vider le cache
./vendor/bin/php-cs-fixer fix --cache-clear

# Utiliser le traitement parallèle
./vendor/bin/php-cs-fixer fix --parallel

# Limite de mémoire
./vendor/bin/php-cs-fixer fix --memory-limit=2G
```

### Scripts Composer

Ajouter à `composer.json` :

```json
{
  "scripts": {
    "cs-fix": "php-cs-fixer fix",
    "cs-fix:dry-run": "php-cs-fixer fix --dry-run --diff",
    "cs-fix:check": "php-cs-fixer fix --dry-run --diff --verbose",
    "cs-fix:cache-clear": "php-cs-fixer fix --cache-clear"
  }
}
```

Puis exécuter :

```bash
composer run cs-fix
composer run cs-fix:dry-run
composer run cs-fix:check
composer run cs-fix:cache-clear
```

## Comprendre les Résultats

### Codes de Sortie

- **0** : Aucune erreur trouvée, tous les fichiers sont correctement formatés
- **1** : Erreur générale (ex: erreur de configuration)
- **4** : Certains fichiers ont une syntaxe invalide
- **8** : Certains fichiers ont besoin d'être corrigés

### Formats de Sortie Courants

#### Sortie Exécution à Sec

```bash
$ ./vendor/bin/php-cs-fixer fix --dry-run --diff

Configuration chargée par défaut depuis "/path/to/.php-cs-fixer.php".
   1/10 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ---------- début diff ----------
--- /path/to/file.php
+++ /path/to/file.php
@@ -1,7 +1,7 @@
 <?php

 declare(strict_types=1);

 namespace App\Application\UseCase\Security;

 final class LoginUseCase
 {
-  public function __construct(
-    private readonly SecurityDataProviderInterface $dataProvider
-  ) {}
+    public function __construct(
+        private readonly SecurityDataProviderInterface $dataProvider
+    ) {}
 }
 ----------- fin diff ----------
```

#### Sortie Fichiers Corrigés

```bash
$ ./vendor/bin/php-cs-fixer fix

Configuration chargée par défaut depuis "/path/to/.php-cs-fixer.php".
   1/10 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

Tous les fichiers ont été corrigés en 0.123 secondes, 2.00 MB de mémoire utilisée.
```

### Corrections Courantes Appliquées

#### 1. Indentation

```php
// Avant
public function __construct(
  private readonly SecurityDataProviderInterface $dataProvider
) {}

// Après
public function __construct(
    private readonly SecurityDataProviderInterface $dataProvider
) {}
```

#### 2. Syntaxe de Tableau

```php
// Avant
$array = array('key' => 'value');

// Après
$array = ['key' => 'value'];
```

#### 3. Guillemets de Chaîne

```php
// Avant
$string = "Hello World";

// Après
$string = 'Hello World';
```

#### 4. Organisation des Imports

```php
// Avant
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\UseCase\Security\LoginUseCase;
use App\Application\Dto\Input\Security\LoginInputDto;

// Après
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\UseCase\Security\LoginUseCase;
```

#### 5. Espacement des Méthodes

```php
// Avant
public function method1() {
    // code
}
public function method2() {
    // code
}

// Après
public function method1()
{
    // code
}

public function method2()
{
    // code
}
```

## Intégration avec CI/CD

### GitHub Actions

```yaml
# .github/workflows/php-cs-fixer.yml
name: PHP CS Fixer

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main]

jobs:
  php-cs-fixer:
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

      - name: Run PHP CS Fixer
        run: ./vendor/bin/php-cs-fixer fix --dry-run --diff --verbose
```

### GitLab CI

```yaml
# .gitlab-ci.yml
php-cs-fixer:
  stage: test
  image: php:8.2-cli
  before_script:
    - composer install --prefer-dist --no-progress
  script:
    - ./vendor/bin/php-cs-fixer fix --dry-run --diff --verbose
  only:
    - merge_requests
    - main
```

### Jenkins Pipeline

```groovy
pipeline {
    agent any

    stages {
        stage('PHP CS Fixer') {
            steps {
                sh 'composer install --prefer-dist --no-progress'
                sh './vendor/bin/php-cs-fixer fix --dry-run --diff --verbose'
            }
        }
    }
}
```

## Bonnes Pratiques

### 1. Commencer avec les Règles de Base

```php
// Commencer avec ces règles
'@PSR12' => true,
'@Symfony' => true,
```

### 2. Utiliser l'Exécution à Sec en Premier

```bash
# Toujours vérifier ce qui sera changé en premier
./vendor/bin/php-cs-fixer fix --dry-run --diff
```

### 3. Exclure le Code Généré

```php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude([
        'Http', // Les contrôleurs sont fins
        'var',  // Fichiers de cache
        'vendor', // Code tiers
    ]);
```

### 4. Utiliser des Règles Spécifiques à Votre Projet

```php
// Ajouter des règles spécifiques à votre clean architecture
'declare_strict_types' => true,
'ordered_imports' => [
    'sort_algorithm' => 'alpha',
    'imports_order' => ['class', 'function', 'const'],
],
'class_attributes_separation' => [
    'elements' => [
        'method' => 'one',
        'property' => 'one',
    ],
],
```

### 5. Intégrer avec les Hooks Pre-commit

```bash
# .git/hooks/pre-commit
#!/bin/sh
./vendor/bin/php-cs-fixer fix --dry-run --diff --verbose
if [ $? -ne 0 ]; then
    echo "PHP CS Fixer a trouvé des problèmes. Veuillez exécuter : composer run cs-fix"
    exit 1
fi
```

### 6. Utiliser l'Intégration IDE

```json
// .vscode/settings.json
{
  "php-cs-fixer.enable": true,
  "php-cs-fixer.config": ".php-cs-fixer.php",
  "php-cs-fixer.onsave": true
}
```

### 7. Maintenance Régulière

```bash
# Exécuter hebdomadairement pour garder le code propre
composer run cs-fix

# Vérifier les nouveaux problèmes
composer run cs-fix:check
```

## Dépannage

### Problèmes Courants

#### 1. Erreurs de Configuration

```bash
# Erreur : Configuration invalide
# Solution : Vérifiez la syntaxe de votre .php-cs-fixer.php
php -l .php-cs-fixer.php
```

#### 2. Problèmes de Mémoire

```bash
# Erreur : Fatal error: Allowed memory size exhausted
./vendor/bin/php-cs-fixer fix --memory-limit=2G
```

#### 3. Performance Lente

```bash
# Utiliser le traitement parallèle
./vendor/bin/php-cs-fixer fix --parallel

# Ou exclure plus de répertoires
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude(['Http', 'var', 'vendor', 'tests']);
```

#### 4. Conflits de Règles

```php
// Certaines règles entrent en conflit
// Solution : Supprimer les règles conflictuelles ou ajuster la configuration
'no_trailing_whitespace' => true,
'no_extra_blank_lines' => true,
// Celles-ci fonctionnent bien ensemble
```

#### 5. Problèmes de Permissions de Fichier

```bash
# Erreur : Permission refusée
chmod +x .git/hooks/pre-commit
```

### Mode Debug

```bash
# Exécuter avec des informations de debug
./vendor/bin/php-cs-fixer fix --verbose --diff

# Afficher quelles règles sont appliquées
./vendor/bin/php-cs-fixer fix --verbose --diff --rules=@PSR12
```

## Utilisation Avancée

### Règles Personnalisées

```php
// Créer une règle personnalisée
class CustomRule implements \PhpCsFixer\Fixer\FixerInterface
{
    public function getName(): string
    {
        return 'custom_rule';
    }

    public function isCandidate(\PhpCsFixer\Tokenizer\Tokens $tokens): bool
    {
        return true;
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function fix(\SplFileInfo $file, \PhpCsFixer\Tokenizer\Tokens $tokens): void
    {
        // Logique personnalisée
    }

    public function getDefinition(): \PhpCsFixer\FixerDefinition\FixerDefinitionInterface
    {
        return new \PhpCsFixer\FixerDefinition\FixerDefinition(
            'Description de la règle personnalisée',
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

### Configuration par Répertoire

```php
$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@Symfony' => true,
    ])
    ->setFinder($finder);

// Règles différentes pour différents répertoires
$config->setRules([
    '@PSR12' => true,
    '@Symfony' => true,
    'declare_strict_types' => true,
]);
```

### Intégration avec d'Autres Outils

```bash
# Exécuter PHP CS Fixer avant PHPStan
composer run cs-fix
composer run phpstan

# Ou combiner dans un script
#!/bin/bash
set -e
composer run cs-fix
composer run phpstan
```

### Ensembles de Correcteurs Personnalisés

```php
// Créer un ensemble de correcteurs personnalisé
$config->setRules([
    '@PSR12' => true,
    '@Symfony' => true,
    '@PhpCsFixer' => true,
    // Ajouter des règles personnalisées
    'declare_strict_types' => true,
    'ordered_imports' => [
        'sort_algorithm' => 'alpha',
        'imports_order' => ['class', 'function', 'const'],
    ],
]);
```

## Configuration Spécifique au Projet

### Pour Notre Clean Architecture

```php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude([
        'Http', // Les contrôleurs sont fins, se concentrer sur la logique métier
        'var',
        'vendor',
    ])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        // Standards de base
        '@PSR12' => true,
        '@Symfony' => true,
        '@PhpCsFixer' => true,

        // Spécifique à la clean architecture
        'declare_strict_types' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['class', 'function', 'const'],
        ],
        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one',
                'property' => 'one',
                'trait_import' => 'none',
            ],
        ],
        'no_unused_imports' => true,
        'single_quote' => true,
        'array_syntax' => ['syntax' => 'short'],
        'trailing_comma_in_multiline' => true,
        'blank_line_before_statement' => [
            'statements' => ['return', 'throw', 'try'],
        ],
    ])
    ->setFinder($finder);
```

### Workflow Recommandé

1. **Commencer par l'exécution à sec** : `composer run cs-fix:dry-run`
2. **Examiner les changements** : Vérifier la sortie diff
3. **Appliquer les corrections** : `composer run cs-fix`
4. **Commiter les changements** : `git add . && git commit -m "Appliquer PHP CS Fixer"`
5. **Intégrer avec CI** : Ajouter à GitHub Actions/GitLab CI
6. **Maintenance régulière** : Exécuter hebdomadairement

## Référence Rapide

### Commandes Essentielles

```bash
# Correction de base
./vendor/bin/php-cs-fixer fix

# Exécution à sec
./vendor/bin/php-cs-fixer fix --dry-run --diff

# Vérifier un fichier spécifique
./vendor/bin/php-cs-fixer fix src/Application/UseCase/Security/LoginUseCase.php

# Sortie verbeuse
./vendor/bin/php-cs-fixer fix --verbose

# Vider le cache
./vendor/bin/php-cs-fixer fix --cache-clear
```

### Scripts Composer

```bash
# Corriger tous les fichiers
composer run cs-fix

# Exécution à sec
composer run cs-fix:dry-run

# Vérifier avec sortie verbeuse
composer run cs-fix:check

# Vider le cache
composer run cs-fix:cache-clear
```

### Ensembles de Règles Courants

- `@PSR12` - Standard de codage PSR-12
- `@Symfony` - Standard de codage Symfony
- `@PhpCsFixer` - Règles recommandées PHP CS Fixer
- `@DoctrineAnnotation` - Règles d'annotation Doctrine
- `@PHP80Migration` - Règles de migration PHP 8.0
- `@PHP81Migration` - Règles de migration PHP 8.1

### Codes de Sortie

- **0** : Aucune erreur trouvée
- **1** : Erreur générale
- **4** : Certains fichiers ont une syntaxe invalide
- **8** : Certains fichiers ont besoin d'être corrigés

---

## 🚀 Commencer

1. **Installer PHP CS Fixer** : `composer require --dev friendsofphp/php-cs-fixer`
2. **Exécuter l'exécution à sec** : `composer run cs-fix:dry-run`
3. **Examiner les changements** dans la sortie diff
4. **Appliquer les corrections** : `composer run cs-fix`
5. **Intégrer avec CI/CD** pour le formatage continu
6. **Configurer les hooks pre-commit** pour le formatage automatique

PHP CS Fixer vous aidera à maintenir un code cohérent, propre et lisible dans votre backend clean architecture ! 🎨
