# 🔍 PHPStan Guide for Clean Architecture Backend

## Overview

PHPStan is a static analysis tool for PHP that helps catch bugs before they reach production. This guide explains how to use PHPStan effectively in our clean architecture backend project.

## 📋 Table of Contents

1. [What is PHPStan?](#what-is-phpstan)
2. [Installation & Setup](#installation--setup)
3. [Configuration](#configuration)
4. [Running PHPStan](#running-phpstan)
5. [Understanding Results](#understanding-results)
6. [Integration with CI/CD](#integration-with-cicd)
7. [Best Practices](#best-practices)
8. [Troubleshooting](#troubleshooting)
9. [Advanced Usage](#advanced-usage)

## What is PHPStan?

PHPStan is a static analysis tool that:
- **Finds bugs** without running code
- **Analyzes types** and catches type-related errors
- **Detects dead code** and unused variables
- **Validates method calls** and property access
- **Checks return types** and parameter types
- **Ensures code quality** and consistency

## Installation & Setup

### Prerequisites
- PHP 8.1 or higher
- Composer

### Installation
```bash
# Install PHPStan
composer require --dev phpstan/phpstan

# Install Symfony-specific rules (optional but recommended)
composer require --dev phpstan/phpstan-symfony

# Install Doctrine rules (if using Doctrine)
composer require --dev phpstan/phpstan-doctrine
```

### Verify Installation
```bash
# Check if PHPStan is installed
./vendor/bin/phpstan --version

# Expected output: PHPStan - PHP Static Analysis Tool 1.x.x
```

## Configuration

### Basic Configuration (`phpstan.neon`)
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
        # Ignore errors in generated files
        - '#Call to an undefined method#'
        # Ignore SOAP client errors (external dependency)
        - '#Call to an undefined method SoapClient#'
    checkMissingIterableValueType: false
    checkGenericClassInNonGenericObjectType: false
    reportUnmatchedIgnoredErrors: false
```

### Advanced Configuration
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
    
    # Include additional rules
    includes:
        - vendor/phpstan/phpstan-symfony/extension.neon
        - vendor/phpstan/phpstan-doctrine/extension.neon
    
    # Ignore specific errors
    ignoreErrors:
        - '#Call to an undefined method#'
        - '#Call to an undefined method SoapClient#'
        - '#Property .* has no type specified#'
    
    # Custom rules
    checkMissingIterableValueType: false
    checkGenericClassInNonGenericObjectType: false
    reportUnmatchedIgnoredErrors: false
    
    # Memory limit
    memoryLimitFile: 2G
```

## Running PHPStan

### Basic Commands
```bash
# Run PHPStan on entire codebase
./vendor/bin/phpstan analyse

# Run with specific level
./vendor/bin/phpstan analyse --level=6

# Run on specific directory
./vendor/bin/phpstan analyse src/Application

# Run on specific file
./vendor/bin/phpstan analyse src/Application/UseCase/Security/LoginUseCase.php

# Generate baseline (ignore current errors)
./vendor/bin/phpstan analyse --generate-baseline

# Use baseline file
./vendor/bin/phpstan analyse --baseline=phpstan-baseline.neon
```

### Advanced Commands
```bash
# Run with memory limit
./vendor/bin/phpstan analyse --memory-limit=2G

# Run with parallel processing
./vendor/bin/phpstan analyse --parallel

# Generate JSON report
./vendor/bin/phpstan analyse --error-format=json > phpstan-report.json

# Run with custom configuration
./vendor/bin/phpstan analyse -c phpstan.neon

# Verbose output
./vendor/bin/phpstan analyse --verbose
```

### Composer Scripts
Add to `composer.json`:
```json
{
    "scripts": {
        "phpstan": "phpstan analyse",
        "phpstan:baseline": "phpstan analyse --generate-baseline",
        "phpstan:ci": "phpstan analyse --error-format=github"
    }
}
```

Then run:
```bash
composer run phpstan
composer run phpstan:baseline
composer run phpstan:ci
```

## Understanding Results

### Error Levels
PHPStan uses levels 0-9, where higher levels catch more issues:

- **Level 0**: Basic checks (undefined variables, unknown classes)
- **Level 1**: Unknown methods, unknown properties
- **Level 2**: Unknown magic methods and properties
- **Level 3**: Unknown methods on mixed types
- **Level 4**: Unknown methods on mixed types with more checks
- **Level 5**: Unknown methods on mixed types with even more checks
- **Level 6**: Unknown methods on mixed types with maximum checks
- **Level 7**: Unknown methods on mixed types with maximum checks + more
- **Level 8**: Unknown methods on mixed types with maximum checks + even more
- **Level 9**: Maximum strictness

### Common Error Types

#### 1. Undefined Variable
```php
// Error: Undefined variable $name
function greet() {
    echo "Hello " . $name; // $name is undefined
}
```

#### 2. Undefined Method
```php
// Error: Call to an undefined method
$user = new User();
$user->getFullName(); // Method doesn't exist
```

#### 3. Type Mismatch
```php
// Error: Parameter #1 $id of method expects int, string given
function getUser(int $id): User {
    return new User($id);
}

getUser("123"); // String instead of int
```

#### 4. Nullable Type Issues
```php
// Error: Cannot call method on nullable type
function processUser(?User $user): string {
    return $user->getName(); // $user might be null
}
```

#### 5. Array Access Issues
```php
// Error: Cannot access offset on mixed type
function getValue(array $data): string {
    return $data['key']; // $data['key'] might not exist
}
```

### Reading Error Messages
```
 ------ -------------------------------------------------------------------------
  Line   src/Application/UseCase/Security/LoginUseCase.php
 ------ -------------------------------------------------------------------------
  25     Call to an undefined method App\Application\Service\DataProvider\SecurityDataProviderInterface::loginService().
 ------ -------------------------------------------------------------------------
```

**Translation:**
- **File**: `src/Application/UseCase/Security/LoginUseCase.php`
- **Line**: 25
- **Issue**: Method `loginService()` doesn't exist on `SecurityDataProviderInterface`

## Integration with CI/CD

### GitHub Actions
```yaml
# .github/workflows/phpstan.yml
name: PHPStan

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main ]

jobs:
  phpstan:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2'
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

## Best Practices

### 1. Start with Level 6
```bash
# Begin with level 6 for good balance
./vendor/bin/phpstan analyse --level=6
```

### 2. Use Baselines
```bash
# Generate baseline to ignore current errors
./vendor/bin/phpstan analyse --generate-baseline

# Use baseline in future runs
./vendor/bin/phpstan analyse --baseline=phpstan-baseline.neon
```

### 3. Focus on Critical Issues First
```bash
# Run with specific error types
./vendor/bin/phpstan analyse --error-format=table | grep "Call to an undefined method"
```

### 4. Exclude Generated Code
```neon
parameters:
    excludePaths:
        - src/Http  # Generated controllers
        - var       # Cache files
        - vendor    # Third-party code
```

### 5. Use Specific Ignores
```neon
parameters:
    ignoreErrors:
        # Ignore specific SOAP client issues
        - '#Call to an undefined method SoapClient::__soapCall#'
        # Ignore specific line
        - '#Call to an undefined method#'
          path: src/Infrastructure/Service/DataSource/SecuritySoap.php
          count: 1
```

### 6. Add Type Hints
```php
// Before
function processUser($user) {
    return $user->getName();
}

// After
function processUser(User $user): string {
    return $user->getName();
}
```

### 7. Use PHPDoc
```php
/**
 * @param array<string, mixed> $data
 * @return array<string, string>
 */
function processData(array $data): array {
    // Implementation
}
```

## Troubleshooting

### Common Issues

#### 1. Memory Limit
```bash
# Error: Fatal error: Allowed memory size exhausted
./vendor/bin/phpstan analyse --memory-limit=2G
```

#### 2. Slow Analysis
```bash
# Use parallel processing
./vendor/bin/phpstan analyse --parallel

# Or reduce level temporarily
./vendor/bin/phpstan analyse --level=4
```

#### 3. False Positives
```neon
# In phpstan.neon
parameters:
    ignoreErrors:
        - '#Call to an undefined method#'
          path: src/Infrastructure/Service/DataSource/SecuritySoap.php
          count: 1
```

#### 4. Missing Extensions
```bash
# Install missing extensions
composer require --dev phpstan/phpstan-symfony
composer require --dev phpstan/phpstan-doctrine
```

### Debug Mode
```bash
# Run with debug information
./vendor/bin/phpstan analyse --debug

# Show only errors (no warnings)
./vendor/bin/phpstan analyse --no-progress
```

## Advanced Usage

### Custom Rules
```php
// Create custom rule
class CustomRule implements \PHPStan\Rules\Rule
{
    public function getNodeType(): string
    {
        return \PhpParser\Node\Expr\MethodCall::class;
    }

    public function processNode(\PhpParser\Node $node, \PHPStan\Analyser\Scope $scope): array
    {
        // Custom logic
        return [];
    }
}
```

### Configuration per Directory
```neon
parameters:
    paths:
        - src
    
    # Different rules for different directories
    rules:
        - PHPStan\Rules\Methods\CallToStaticMethodStaticallyRule
        - PHPStan\Rules\Functions\CallToNonExistentFunctionRule
```

### Integration with IDE
```json
// .vscode/settings.json
{
    "phpstan.enabled": true,
    "phpstan.configFile": "phpstan.neon",
    "phpstan.level": 6
}
```

### Custom Error Formatters
```php
// Create custom formatter
class CustomFormatter implements \PHPStan\Command\ErrorFormatter\ErrorFormatter
{
    public function formatErrors(
        \PHPStan\Command\AnalysisResult $analysisResult,
        \Symfony\Component\Console\Style\OutputStyle $style
    ): int {
        // Custom formatting logic
        return 0;
    }
}
```

## Project-Specific Configuration

### For Our Clean Architecture
```neon
parameters:
    level: 6
    paths:
        - src
    excludePaths:
        - src/Http  # Controllers are thin, focus on business logic
        - var
        - vendor
    
    # Focus on Application and Infrastructure layers
    ignoreErrors:
        # SOAP client is external dependency
        - '#Call to an undefined method SoapClient#'
        # Symfony container is external
        - '#Call to an undefined method Symfony\\Component\\DependencyInjection\\ContainerInterface#'
    
    # Check for common issues in our architecture
    checkMissingIterableValueType: false
    checkGenericClassInNonGenericObjectType: false
    reportUnmatchedIgnoredErrors: false
```

### Recommended Workflow
1. **Start with baseline**: `./vendor/bin/phpstan analyse --generate-baseline`
2. **Fix critical issues**: Focus on undefined methods and type errors
3. **Gradually increase level**: Move from level 6 to 8 over time
4. **Integrate with CI**: Add to GitHub Actions/GitLab CI
5. **Regular maintenance**: Run weekly and fix new issues

## Quick Reference

### Essential Commands
```bash
# Basic analysis
./vendor/bin/phpstan analyse

# With specific level
./vendor/bin/phpstan analyse --level=6

# Generate baseline
./vendor/bin/phpstan analyse --generate-baseline

# Use baseline
./vendor/bin/phpstan analyse --baseline=phpstan-baseline.neon

# Parallel processing
./vendor/bin/phpstan analyse --parallel

# Memory limit
./vendor/bin/phpstan analyse --memory-limit=2G
```

### Configuration Levels
- **Level 0-2**: Basic checks (start here)
- **Level 3-4**: Good balance for most projects
- **Level 5-6**: Recommended for production
- **Level 7-8**: Strict (use gradually)
- **Level 9**: Maximum strictness (advanced)

### Common Error Patterns
- `Call to an undefined method` → Method doesn't exist
- `Parameter #X expects Y, Z given` → Type mismatch
- `Cannot call method on nullable type` → Null safety issue
- `Cannot access offset on mixed type` → Array access issue
- `Property has no type specified` → Missing type hint

---

## 🚀 Getting Started

1. **Install PHPStan**: `composer require --dev phpstan/phpstan`
2. **Run basic analysis**: `./vendor/bin/phpstan analyse`
3. **Generate baseline**: `./vendor/bin/phpstan analyse --generate-baseline`
4. **Fix critical issues** one by one
5. **Integrate with CI/CD** for continuous quality

PHPStan will help you maintain high code quality and catch bugs early in your clean architecture backend! 🎯
