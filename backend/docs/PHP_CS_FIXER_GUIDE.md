# 🎨 PHP CS Fixer Guide for Clean Architecture Backend

## Overview

PHP CS Fixer is a tool to automatically fix PHP code to follow a coding standard. This guide explains how to use PHP CS Fixer effectively in our clean architecture backend project.

## 📋 Table of Contents

1. [What is PHP CS Fixer?](#what-is-php-cs-fixer)
2. [Installation & Setup](#installation--setup)
3. [Configuration](#configuration)
4. [Running PHP CS Fixer](#running-php-cs-fixer)
5. [Understanding Results](#understanding-results)
6. [Integration with CI/CD](#integration-with-cicd)
7. [Best Practices](#best-practices)
8. [Troubleshooting](#troubleshooting)
9. [Advanced Usage](#advanced-usage)

## What is PHP CS Fixer?

PHP CS Fixer is a tool that:

- **Automatically fixes** PHP code to follow coding standards
- **Enforces consistency** across your codebase
- **Supports multiple standards** (PSR-12, Symfony, etc.)
- **Integrates with IDEs** and CI/CD pipelines
- **Improves code readability** and maintainability
- **Reduces code review time** by handling formatting automatically

## Installation & Setup

### Prerequisites

- PHP 8.2 or higher
- Composer

### Installation

```bash
# Install PHP CS Fixer
composer require --dev friendsofphp/php-cs-fixer

# Verify installation
./vendor/bin/php-cs-fixer --version
```

### Verify Installation

```bash
# Check if PHP CS Fixer is installed
./vendor/bin/php-cs-fixer --version

# Expected output: PHP CS Fixer 3.x.x Folding Bike by Fabien Potencier...
```

## Configuration

### Basic Configuration (`.php-cs-fixer.php`)

```php
<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude([
        'Http', // Exclude controllers as they are thin
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
        // ... additional rules
    ])
    ->setFinder($finder);

return $config;
```

### Advanced Configuration

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
        // Basic rules
        '@PSR12' => true,
        '@Symfony' => true,
        '@PhpCsFixer' => true,

        // Array rules
        'array_syntax' => ['syntax' => 'short'],
        'array_indentation' => true,
        'trim_array_spaces' => true,
        'whitespace_after_comma_in_array' => true,

        // Class rules
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

        // Function rules
        'function_declaration' => [
            'closure_function_spacing' => 'one',
        ],
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],

        // String rules
        'single_quote' => true,
        'concat_space' => ['spacing' => 'one'],
        'escape_implicit_backslashes' => true,

        // Control structure rules
        'control_structure_braces' => true,
        'control_structure_continuation_position' => true,
        'elseif' => true,
        'no_alternative_syntax' => true,
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'switch_continue_to_break' => true,

        // Operator rules
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

        // Cast rules
        'cast_spaces' => true,
        'no_short_bool_cast' => true,

        // Comment rules
        'single_line_comment_style' => [
            'comment_types' => ['hash'],
        ],
        'multiline_comment_opening_closing' => true,

        // General rules
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

## Running PHP CS Fixer

### Basic Commands

```bash
# Fix all files
./vendor/bin/php-cs-fixer fix

# Dry run (show what would be changed)
./vendor/bin/php-cs-fixer fix --dry-run --diff

# Fix specific file
./vendor/bin/php-cs-fixer fix src/Application/UseCase/Security/LoginUseCase.php

# Fix specific directory
./vendor/bin/php-cs-fixer fix src/Application/

# Verbose output
./vendor/bin/php-cs-fixer fix --verbose

# Show progress
./vendor/bin/php-cs-fixer fix --show-progress
```

### Advanced Commands

```bash
# Use custom configuration
./vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php

# Fix with specific rules
./vendor/bin/php-cs-fixer fix --rules=@PSR12

# Fix with multiple rules
./vendor/bin/php-cs-fixer fix --rules=@PSR12,@Symfony

# Stop on first violation
./vendor/bin/php-cs-fixer fix --stop-on-violation

# Clear cache
./vendor/bin/php-cs-fixer fix --cache-clear

# Use parallel processing
./vendor/bin/php-cs-fixer fix --parallel

# Memory limit
./vendor/bin/php-cs-fixer fix --memory-limit=2G
```

### Composer Scripts

Add to `composer.json`:

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

Then run:

```bash
composer run cs-fix
composer run cs-fix:dry-run
composer run cs-fix:check
composer run cs-fix:cache-clear
```

## Understanding Results

### Exit Codes

- **0**: No errors found, all files are properly formatted
- **1**: General error (e.g., configuration error)
- **4**: Some files have invalid syntax
- **8**: Some files need fixing

### Common Output Formats

#### Dry Run Output

```bash
$ ./vendor/bin/php-cs-fixer fix --dry-run --diff

Loaded config default from "/path/to/.php-cs-fixer.php".
   1/10 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ---------- begin diff ----------
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
 ----------- end diff -----------
```

#### Fixed Files Output

```bash
$ ./vendor/bin/php-cs-fixer fix

Loaded config default from "/path/to/.php-cs-fixer.php".
   1/10 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

Fixed all files in 0.123 seconds, 2.00 MB memory used.
```

### Common Fixes Applied

#### 1. Indentation

```php
// Before
public function __construct(
  private readonly SecurityDataProviderInterface $dataProvider
) {}

// After
public function __construct(
    private readonly SecurityDataProviderInterface $dataProvider
) {}
```

#### 2. Array Syntax

```php
// Before
$array = array('key' => 'value');

// After
$array = ['key' => 'value'];
```

#### 3. String Quotes

```php
// Before
$string = "Hello World";

// After
$string = 'Hello World';
```

#### 4. Import Organization

```php
// Before
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\UseCase\Security\LoginUseCase;
use App\Application\Dto\Input\Security\LoginInputDto;

// After
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\UseCase\Security\LoginUseCase;
```

#### 5. Method Spacing

```php
// Before
public function method1() {
    // code
}
public function method2() {
    // code
}

// After
public function method1()
{
    // code
}

public function method2()
{
    // code
}
```

## Integration with CI/CD

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

## Best Practices

### 1. Start with Basic Rules

```php
// Start with these rules
'@PSR12' => true,
'@Symfony' => true,
```

### 2. Use Dry Run First

```bash
# Always check what will be changed first
./vendor/bin/php-cs-fixer fix --dry-run --diff
```

### 3. Exclude Generated Code

```php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude([
        'Http', // Controllers are thin
        'var',  // Cache files
        'vendor', // Third-party code
    ]);
```

### 4. Use Specific Rules for Your Project

```php
// Add rules specific to your clean architecture
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

### 5. Integrate with Pre-commit Hooks

```bash
# .git/hooks/pre-commit
#!/bin/sh
./vendor/bin/php-cs-fixer fix --dry-run --diff --verbose
if [ $? -ne 0 ]; then
    echo "PHP CS Fixer found issues. Please run: composer run cs-fix"
    exit 1
fi
```

### 6. Use IDE Integration

```json
// .vscode/settings.json
{
  "php-cs-fixer.enable": true,
  "php-cs-fixer.config": ".php-cs-fixer.php",
  "php-cs-fixer.onsave": true
}
```

### 7. Regular Maintenance

```bash
# Run weekly to keep code clean
composer run cs-fix

# Check for new issues
composer run cs-fix:check
```

## Troubleshooting

### Common Issues

#### 1. Configuration Errors

```bash
# Error: Invalid configuration
# Solution: Check your .php-cs-fixer.php syntax
php -l .php-cs-fixer.php
```

#### 2. Memory Issues

```bash
# Error: Fatal error: Allowed memory size exhausted
./vendor/bin/php-cs-fixer fix --memory-limit=2G
```

#### 3. Slow Performance

```bash
# Use parallel processing
./vendor/bin/php-cs-fixer fix --parallel

# Or exclude more directories
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude(['Http', 'var', 'vendor', 'tests']);
```

#### 4. Rule Conflicts

```php
// Some rules conflict with each other
// Solution: Remove conflicting rules or adjust configuration
'no_trailing_whitespace' => true,
'no_extra_blank_lines' => true,
// These work well together
```

#### 5. File Permission Issues

```bash
# Error: Permission denied
chmod +x .git/hooks/pre-commit
```

### Debug Mode

```bash
# Run with debug information
./vendor/bin/php-cs-fixer fix --verbose --diff

# Show which rules are being applied
./vendor/bin/php-cs-fixer fix --verbose --diff --rules=@PSR12
```

## Advanced Usage

### Custom Rules

```php
// Create custom rule
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
        // Custom logic
    }

    public function getDefinition(): \PhpCsFixer\FixerDefinition\FixerDefinitionInterface
    {
        return new \PhpCsFixer\FixerDefinition\FixerDefinition(
            'Custom rule description',
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

### Configuration per Directory

```php
$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@Symfony' => true,
    ])
    ->setFinder($finder);

// Different rules for different directories
$config->setRules([
    '@PSR12' => true,
    '@Symfony' => true,
    'declare_strict_types' => true,
]);
```

### Integration with Other Tools

```bash
# Run PHP CS Fixer before PHPStan
composer run cs-fix
composer run phpstan

# Or combine in one script
#!/bin/bash
set -e
composer run cs-fix
composer run phpstan
```

### Custom Fixer Sets

```php
// Create custom fixer set
$config->setRules([
    '@PSR12' => true,
    '@Symfony' => true,
    '@PhpCsFixer' => true,
    // Add custom rules
    'declare_strict_types' => true,
    'ordered_imports' => [
        'sort_algorithm' => 'alpha',
        'imports_order' => ['class', 'function', 'const'],
    ],
]);
```

## Project-Specific Configuration

### For Our Clean Architecture

```php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->exclude([
        'Http', // Controllers are thin, focus on business logic
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
        // Basic standards
        '@PSR12' => true,
        '@Symfony' => true,
        '@PhpCsFixer' => true,

        // Clean architecture specific
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

### Recommended Workflow

1. **Start with dry run**: `composer run cs-fix:dry-run`
2. **Review changes**: Check the diff output
3. **Apply fixes**: `composer run cs-fix`
4. **Commit changes**: `git add . && git commit -m "Apply PHP CS Fixer"`
5. **Integrate with CI**: Add to GitHub Actions/GitLab CI
6. **Regular maintenance**: Run weekly

## Quick Reference

### Essential Commands

```bash
# Basic fix
./vendor/bin/php-cs-fixer fix

# Dry run
./vendor/bin/php-cs-fixer fix --dry-run --diff

# Check specific file
./vendor/bin/php-cs-fixer fix src/Application/UseCase/Security/LoginUseCase.php

# Verbose output
./vendor/bin/php-cs-fixer fix --verbose

# Clear cache
./vendor/bin/php-cs-fixer fix --cache-clear
```

### Composer Scripts

```bash
# Fix all files
composer run cs-fix

# Dry run
composer run cs-fix:dry-run

# Check with verbose output
composer run cs-fix:check

# Clear cache
composer run cs-fix:cache-clear
```

### Common Rule Sets

- `@PSR12` - PSR-12 coding standard
- `@Symfony` - Symfony coding standard
- `@PhpCsFixer` - PHP CS Fixer recommended rules
- `@DoctrineAnnotation` - Doctrine annotation rules
- `@PHP80Migration` - PHP 8.0 migration rules
- `@PHP81Migration` - PHP 8.1 migration rules

### Exit Codes

- **0**: No errors found
- **1**: General error
- **4**: Some files have invalid syntax
- **8**: Some files need fixing

---

## 🚀 Getting Started

1. **Install PHP CS Fixer**: `composer require --dev friendsofphp/php-cs-fixer`
2. **Run dry run**: `composer run cs-fix:dry-run`
3. **Review changes** in the diff output
4. **Apply fixes**: `composer run cs-fix`
5. **Integrate with CI/CD** for continuous formatting
6. **Set up pre-commit hooks** for automatic formatting

PHP CS Fixer will help you maintain consistent, clean, and readable code across your clean architecture backend! 🎨
