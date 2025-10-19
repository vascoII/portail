# 🛡️ Security Audit Guide for Clean Architecture Backend

## Overview

Security auditing is a critical part of maintaining a secure codebase. This guide covers how to use security audit tools to identify vulnerabilities in your dependencies and code, ensuring your clean architecture backend remains secure.

## 📋 Table of Contents

1. [What is Security Auditing?](#what-is-security-auditing)
2. [Security vs Clean Code](#security-vs-clean-code)
3. [Tools Overview](#tools-overview)
4. [Dependency Security Auditing](#dependency-security-auditing)
5. [Code Security Analysis](#code-security-analysis)
6. [Integration with CI/CD](#integration-with-cicd)
7. [Best Practices](#best-practices)
8. [Troubleshooting](#troubleshooting)
9. [Advanced Security](#advanced-security)

## What is Security Auditing?

Security auditing involves:

- **Scanning dependencies** for known vulnerabilities (CVEs)
- **Analyzing code** for security anti-patterns
- **Checking configurations** for security misconfigurations
- **Monitoring** for new security threats
- **Maintaining** a secure development lifecycle

## Security vs Clean Code

| Aspect        | Security Auditing                    | Clean Code Tools                       |
| ------------- | ------------------------------------ | -------------------------------------- |
| **Purpose**   | Find vulnerabilities & threats       | Improve code quality & maintainability |
| **Focus**     | Security risks, CVEs, exploits       | Style, consistency, type safety        |
| **Tools**     | Security scanners, vulnerability DBs | Linters, formatters, static analyzers  |
| **Priority**  | Critical (security breaches)         | Important (code quality)               |
| **Frequency** | Daily/continuous                     | Pre-commit/CI                          |

### Complete Development Toolchain

```bash
# 1. Security Audit (Dependencies)
composer run security:check

# 2. Code Formatting (Style)
composer run cs-fix

# 3. Static Analysis (Types & Logic)
composer run phpstan

# 4. Testing (Functionality)
composer run test
```

## Tools Overview

### 1. **Dependency Security Tools**

- **`composer audit`** - Built-in Composer security (Composer 2.4+)
- **`security-checker`** - Symfony Security Checker
- **`snyk`** - Commercial security platform
- **`github/dependabot`** - Automated dependency updates

### 2. **Code Security Tools**

- **`phpcs-security-audit`** - PHP CodeSniffer security rules
- **`psalm`** - Static analysis with security focus
- **`phpstan-security-rules`** - PHPStan security extensions
- **`roave/security-advisories`** - Composer security constraints

### 3. **Infrastructure Security**

- **`docker scout`** - Container vulnerability scanning
- **`trivy`** - Container and filesystem scanning
- **`bandit`** - Python security linter (if using Python tools)

## Dependency Security Auditing

### Using Security Checker

#### Basic Commands

```bash
# Check all dependencies for vulnerabilities
composer run security:check

# JSON output for CI/CD
composer run security:check:json

# ANSI colored output
composer run security:check:ansi

# Table format
composer run security:check:table
```

#### Advanced Commands

```bash
# Check specific lock file
./vendor/bin/security-checker security:check composer.lock

# Check with custom format
./vendor/bin/security-checker security:check --format=json

# Check with exit code on vulnerabilities
./vendor/bin/security-checker security:check --exit-code

# Verbose output
./vendor/bin/security-checker security:check --verbose
```

### Understanding Security Checker Output

#### ✅ **No Vulnerabilities Found**

```bash
$ composer run security:check
[OK] 0 packages have known vulnerabilities
```

#### ⚠️ **Vulnerabilities Found**

```bash
$ composer run security:check
[WARNING] 2 packages have known vulnerabilities

symfony/http-foundation (v5.4.0)
  CVE-2022-24894: Session fixation vulnerability
  More info: https://symfony.com/cve-2022-24894

monolog/monolog (v2.8.0)
  CVE-2022-21724: Remote code execution
  More info: https://github.com/advisories/GHSA-2q2h-3535-4p6h
```

#### JSON Output (for CI/CD)

```json
{
  "advisories": {
    "symfony/http-foundation": [
      {
        "title": "Session fixation vulnerability",
        "link": "https://symfony.com/cve-2022-24894",
        "cve": "CVE-2022-24894"
      }
    ]
  }
}
```

### Using Composer Audit (Composer 2.4+)

If you upgrade to Composer 2.4+, you can use the built-in audit command:

```bash
# Check for vulnerabilities
composer audit

# Check with specific format
composer audit --format=json

# Check with exit code on vulnerabilities
composer audit --audit-format=table
```

## Code Security Analysis

### PHP Security CodeSniffer

Install and configure PHPCS with security rules:

```bash
# Install PHPCS with security rules
composer require --dev phpcs-security-audit/phpcs-security-audit

# Run security analysis
./vendor/bin/phpcs --standard=Security --extensions=php src/
```

### Security Rules Examples

#### 1. **SQL Injection Prevention**

```php
// ❌ Vulnerable
$query = "SELECT * FROM users WHERE id = " . $_GET['id'];

// ✅ Secure
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_GET['id']]);
```

#### 2. **XSS Prevention**

```php
// ❌ Vulnerable
echo $_GET['name'];

// ✅ Secure
echo htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');
```

#### 3. **File Upload Security**

```php
// ❌ Vulnerable
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);

// ✅ Secure
$allowedTypes = ['image/jpeg', 'image/png'];
$maxSize = 2 * 1024 * 1024; // 2MB

if (in_array($_FILES['file']['type'], $allowedTypes) &&
    $_FILES['file']['size'] <= $maxSize) {
    $filename = uniqid() . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $filename);
}
```

### Custom Security Rules

Create custom security rules for your clean architecture:

```xml
<!-- phpcs.xml -->
<?xml version="1.0"?>
<ruleset name="Security Rules">
    <description>Custom security rules for clean architecture</description>

    <!-- Include security rules -->
    <rule ref="Security"/>

    <!-- Custom rules for our architecture -->
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

    <!-- Check for direct database queries in Application layer -->
    <rule ref="Generic.Files.LineLength">
        <properties>
            <property name="lineLimit" value="120"/>
            <property name="absoluteLineLimit" value="150"/>
        </properties>
    </rule>
</ruleset>
```

## Integration with CI/CD

### GitHub Actions Security Workflow

```yaml
# .github/workflows/security.yml
name: Security Audit

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main]
  schedule:
    - cron: "0 2 * * *" # Daily at 2 AM

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

      - name: Security Check
        run: composer run security:check

      - name: Security Check JSON (for reporting)
        run: composer run security:check:json > security-report.json

      - name: Upload security report
        uses: actions/upload-artifact@v3
        with:
          name: security-report
          path: security-report.json
```

### GitLab CI Security Pipeline

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

### Jenkins Security Pipeline

```groovy
pipeline {
    agent any

    stages {
        stage('Security Audit') {
            steps {
                sh 'composer install --prefer-dist --no-progress'
                sh 'composer run security:check'
            }
        }

        stage('Security Report') {
            steps {
                sh 'composer run security:check:json > security-report.json'
                archiveArtifacts artifacts: 'security-report.json'
            }
        }
    }
}
```

## Best Practices

### 1. **Daily Security Checks**

```bash
# Add to your daily routine
composer run security:check
composer run cs-fix:check
composer run phpstan
```

### 2. **Automated Dependency Updates**

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

### 3. **Security-First Development**

```php
// Always validate input
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
            throw new ValidationException('Username and password are required');
        }

        if (strlen($this->username) > 255) {
            throw new ValidationException('Username too long');
        }
    }
}
```

### 4. **Secure Configuration**

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
        lifetime: 604800 # 1 week
```

### 5. **Environment-Specific Security**

```bash
# .env.local (never commit)
APP_ENV=prod
APP_SECRET=your-super-secret-key-here
DATABASE_URL="mysql://user:password@localhost:3306/database"
REDIS_URL="redis://localhost:6379"

# .env (safe defaults)
APP_ENV=dev
APP_SECRET=dev-secret-key
DATABASE_URL="mysql://root:@localhost:3306/portail_dev"
REDIS_URL="redis://localhost:6379"
```

## Troubleshooting

### Common Security Issues

#### 1. **Outdated Dependencies**

```bash
# Check for outdated packages
composer outdated

# Update specific package
composer update symfony/http-foundation

# Update all packages (be careful!)
composer update
```

#### 2. **Vulnerability False Positives**

```bash
# Check specific package
./vendor/bin/security-checker security:check symfony/http-foundation

# Check with verbose output
./vendor/bin/security-checker security:check --verbose
```

#### 3. **Memory Issues**

```bash
# Increase memory limit
php -d memory_limit=2G ./vendor/bin/security-checker security:check
```

#### 4. **Network Issues**

```bash
# Check with timeout
./vendor/bin/security-checker security:check --timeout=30

# Check offline (if you have cached data)
./vendor/bin/security-checker security:check --no-ansi
```

### Security Checker Configuration

Create a configuration file for custom settings:

```yaml
# security-checker.yaml
security_checker:
  timeout: 30
  format: table
  exit_code: true
  cache_dir: var/cache/security
```

## Advanced Security

### 1. **Custom Security Rules**

Create custom security rules for your clean architecture:

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
        return true; // Security rules are risky
    }

    public function fix(\SplFileInfo $file, \PhpCsFixer\Tokenizer\Tokens $tokens): void
    {
        // Custom security logic
        for ($index = 0; $index < $tokens->count(); ++$index) {
            $token = $tokens[$index];

            if ($token->isGivenKind(T_STRING) && $token->getContent() === 'eval') {
                throw new \RuntimeException('eval() function is not allowed for security reasons');
            }
        }
    }

    public function getDefinition(): \PhpCsFixer\FixerDefinition\FixerDefinitionInterface
    {
        return new \PhpCsFixer\FixerDefinition\FixerDefinition(
            'Custom security rule to prevent dangerous functions',
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

### 2. **Security Monitoring**

Set up continuous security monitoring:

```bash
# Daily security check script
#!/bin/bash
# scripts/daily-security-check.sh

echo "🔍 Running daily security audit..."

# Check dependencies
composer run security:check

# Check code security
./vendor/bin/phpcs --standard=Security src/

# Generate report
composer run security:check:json > reports/security-$(date +%Y%m%d).json

echo "✅ Security audit complete"
```

### 3. **Security Alerts**

Set up alerts for new vulnerabilities:

```yaml
# .github/workflows/security-alerts.yml
name: Security Alerts

on:
  schedule:
    - cron: "0 9 * * *" # Daily at 9 AM
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

      - name: Security Check
        run: composer run security:check

      - name: Create Issue on Vulnerability
        if: failure()
        uses: actions/github-script@v6
        with:
          script: |
            github.rest.issues.create({
              owner: context.repo.owner,
              repo: context.repo.repo,
              title: '🚨 Security Vulnerability Detected',
              body: 'A security vulnerability was detected in dependencies. Please review and update.',
              labels: ['security', 'urgent']
            })
```

## Project-Specific Security

### For Our Clean Architecture

```bash
# Complete security audit workflow
composer run security:check && \
composer run cs-fix:check && \
composer run phpstan && \
echo "✅ All security and quality checks passed"
```

### Security Checklist

- [ ] **Dependencies**: No known vulnerabilities
- [ ] **Input Validation**: All inputs validated and sanitized
- [ ] **Authentication**: Secure password hashing and session management
- [ ] **Authorization**: Proper access control and permissions
- [ ] **Data Protection**: Sensitive data encrypted and protected
- [ ] **Error Handling**: No sensitive information in error messages
- [ ] **Logging**: Security events properly logged
- [ ] **Configuration**: Secure default configurations
- [ ] **Dependencies**: Regular updates and monitoring
- [ ] **Code Review**: Security-focused code reviews

## Quick Reference

### Essential Commands

```bash
# Security audit
composer run security:check

# Security with JSON output
composer run security:check:json

# Code formatting
composer run cs-fix

# Static analysis
composer run phpstan

# Complete audit
composer run security:check && composer run cs-fix:check && composer run phpstan
```

### Security Tools Integration

```bash
# 1. Security Check (Dependencies)
composer run security:check

# 2. Code Formatting (Style)
composer run cs-fix

# 3. Static Analysis (Types)
composer run phpstan

# 4. Security Code Analysis
./vendor/bin/phpcs --standard=Security src/
```

### Exit Codes

- **0**: No vulnerabilities found
- **1**: Vulnerabilities found
- **2**: Error occurred

---

## 🚀 Getting Started

1. **Install security tools**: `composer require --dev enlightn/security-checker`
2. **Run security check**: `composer run security:check`
3. **Integrate with CI/CD**: Add security checks to your pipeline
4. **Set up monitoring**: Configure daily security audits
5. **Review and update**: Regularly check for new vulnerabilities

Security auditing is essential for maintaining a secure, reliable clean architecture backend! 🛡️✨
