# E2E Tests Documentation

## Overview

This document provides comprehensive documentation for the End-to-End (E2E) tests implemented for the Techem Portail backend application. E2E tests simulate real user interactions by making actual HTTP requests to the API endpoints, ensuring that the application works correctly from a user's perspective.

## Table of Contents

1. [Architecture & Design](#architecture--design)
2. [Test Structure](#test-structure)
3. [Security Module Tests](#security-module-tests)
4. [Base Test Class](#base-test-class)
5. [Configuration & Setup](#configuration--setup)
6. [Running Tests](#running-tests)
7. [Test Patterns & Best Practices](#test-patterns--best-practices)
8. [Security Testing](#security-testing)
9. [Maintenance & Debugging](#maintenance--debugging)
10. [Continuous Integration](#continuous-integration)

## Architecture & Design

### Philosophy

E2E tests follow the principle of **minimal mocking** to ensure real-world testing scenarios. Unlike unit or integration tests that mock dependencies, E2E tests:

- Make actual HTTP requests to running application instances
- Use real database connections (test database)
- Validate complete user workflows
- Test security measures under realistic conditions
- Verify API contracts and response formats

### Test Pyramid Position

E2E tests sit at the top of the testing pyramid, providing:

- **High confidence** in application functionality
- **Real-world validation** of user workflows
- **End-to-end verification** of system integration
- **Security validation** against actual threats

## Test Structure

### Directory Organization

```
tests/E2E/
├── BaseE2ETest.php              # Base class with common functionality
├── Security/                    # Security module E2E tests
│   ├── LoginFlowTest.php        # User authentication flow tests
│   ├── PasswordResetFlowTest.php # Password reset workflow tests
│   └── UpdatePasswordFlowTest.php # Password update workflow tests
├── README.md                    # Quick reference guide
└── phpunit-e2e.xml.dist        # PHPUnit configuration for E2E tests
```

### Test Categories

#### 1. **Authentication Flow Tests** (`LoginFlowTest`)

Tests the complete user login process including:

- Valid credential authentication
- Invalid credential handling
- Input validation and sanitization
- Security attack prevention
- Rate limiting behavior
- Response structure validation

#### 2. **Password Reset Flow Tests** (`PasswordResetFlowTest`)

Tests the password recovery process including:

- Email-based reset requests
- Token validation and expiration
- Password strength requirements
- Security attack prevention
- Token reuse prevention

#### 3. **Password Update Flow Tests** (`UpdatePasswordFlowTest`)

Tests the password change process including:

- Authenticated password updates
- Current password verification
- New password validation
- Security attack prevention
- Authorization checks

## Security Module Tests

### LoginFlowTest (15 Tests)

| Test Method                        | Purpose                      | Expected Outcome                |
| ---------------------------------- | ---------------------------- | ------------------------------- |
| `testSuccessfulLoginFlow`          | Valid credentials login      | ✅ Success with token           |
| `testLoginWithInvalidCredentials`  | Wrong credentials            | ❌ 401 Unauthorized             |
| `testLoginWithMissingEmail`        | Missing email field          | ❌ 400 Bad Request              |
| `testLoginWithMissingPassword`     | Missing password field       | ❌ 400 Bad Request              |
| `testLoginWithEmptyCredentials`    | Empty request body           | ❌ 400 Bad Request              |
| `testLoginWithMalformedEmail`      | Invalid email format         | ❌ 400 Bad Request              |
| `testLoginWithShortPassword`       | Weak password                | ❌ 400 Bad Request              |
| `testLoginWithSpecialCharacters`   | Special chars in credentials | ✅/❌ Depends on user existence |
| `testLoginWithUnicodeCharacters`   | Unicode in credentials       | ✅/❌ Depends on user existence |
| `testLoginWithVeryLongCredentials` | Extremely long input         | ✅/❌ Graceful handling         |
| `testLoginWithSQLInjectionAttempt` | SQL injection attack         | ❌ 401 Unauthorized             |
| `testLoginWithXSSAttempt`          | XSS attack attempt           | ❌ 400 Bad Request              |
| `testLoginRateLimiting`            | Multiple failed attempts     | ❌ 429 Rate Limited             |
| `testLoginWithDifferentUserTypes`  | Admin vs user login          | ✅ Success for both types       |
| `testLoginResponseStructure`       | Response format validation   | ✅ Proper JSON structure        |

### PasswordResetFlowTest (17 Tests)

| Test Method                                | Purpose                        | Expected Outcome                  |
| ------------------------------------------ | ------------------------------ | --------------------------------- |
| `testSuccessfulPasswordResetFlow`          | Complete reset workflow        | ✅ Success with new password      |
| `testPasswordResetWithInvalidEmail`        | Non-existent email             | ✅ Success (prevents enumeration) |
| `testPasswordResetWithMissingEmail`        | Missing email field            | ❌ 400 Bad Request                |
| `testPasswordResetWithMalformedEmail`      | Invalid email format           | ❌ 400 Bad Request                |
| `testPasswordResetWithInvalidToken`        | Wrong reset token              | ❌ 400 Bad Request                |
| `testPasswordResetWithExpiredToken`        | Expired reset token            | ❌ 400 Bad Request                |
| `testPasswordResetWithMismatchedPasswords` | Password confirmation mismatch | ❌ 400 Bad Request                |
| `testPasswordResetWithWeakPassword`        | Weak new password              | ❌ 400 Bad Request                |
| `testPasswordResetWithMissingFields`       | Incomplete request             | ❌ 400 Bad Request                |
| `testPasswordResetWithEmptyFields`         | Empty field values             | ❌ 400 Bad Request                |
| `testPasswordResetRateLimiting`            | Multiple reset requests        | ❌ 429 Rate Limited               |
| `testPasswordResetWithSpecialCharacters`   | Special chars in password      | ✅/❌ Depends on policy           |
| `testPasswordResetWithUnicodeCharacters`   | Unicode in password            | ✅/❌ Depends on policy           |
| `testPasswordResetWithVeryLongPassword`    | Extremely long password        | ✅/❌ Graceful handling           |
| `testPasswordResetWithSQLInjectionAttempt` | SQL injection attack           | ❌ 400 Bad Request                |
| `testPasswordResetWithXSSAttempt`          | XSS attack attempt             | ❌ 400 Bad Request                |
| `testPasswordResetTokenReuse`              | Token reuse attempt            | ❌ 400 Bad Request                |

### UpdatePasswordFlowTest (20 Tests)

| Test Method                                          | Purpose                        | Expected Outcome             |
| ---------------------------------------------------- | ------------------------------ | ---------------------------- |
| `testSuccessfulPasswordUpdateFlow`                   | Valid password update          | ✅ Success with new password |
| `testPasswordUpdateWithoutAuthentication`            | Unauthenticated request        | ❌ 401 Unauthorized          |
| `testPasswordUpdateWithWrongCurrentPassword`         | Incorrect current password     | ❌ 400 Bad Request           |
| `testPasswordUpdateWithMismatchedNewPasswords`       | Password confirmation mismatch | ❌ 400 Bad Request           |
| `testPasswordUpdateWithWeakNewPassword`              | Weak new password              | ❌ 400 Bad Request           |
| `testPasswordUpdateWithSamePassword`                 | Same as current password       | ❌ 400 Bad Request           |
| `testPasswordUpdateWithMissingFields`                | Incomplete request             | ❌ 400 Bad Request           |
| `testPasswordUpdateWithEmptyFields`                  | Empty field values             | ❌ 400 Bad Request           |
| `testPasswordUpdateWithSpecialCharacters`            | Special chars in password      | ✅/❌ Depends on policy      |
| `testPasswordUpdateWithUnicodeCharacters`            | Unicode in password            | ✅/❌ Depends on policy      |
| `testPasswordUpdateWithVeryLongPassword`             | Extremely long password        | ✅/❌ Graceful handling      |
| `testPasswordUpdateWithSQLInjectionAttempt`          | SQL injection attack           | ❌ 400 Bad Request           |
| `testPasswordUpdateWithXSSAttempt`                   | XSS attack attempt             | ❌ 400 Bad Request           |
| `testPasswordUpdateWithExpiredToken`                 | Expired authentication token   | ❌ 401 Unauthorized          |
| `testPasswordUpdateWithInvalidToken`                 | Invalid authentication token   | ❌ 401 Unauthorized          |
| `testPasswordUpdateWithWhitespaceInPasswords`        | Whitespace handling            | ✅/❌ Depends on trimming    |
| `testPasswordUpdateWithCaseSensitiveCurrentPassword` | Case sensitivity               | ❌ 400 Bad Request           |
| `testPasswordUpdateWithAdminUser`                    | Admin user password update     | ✅ Success                   |
| `testPasswordUpdateResponseStructure`                | Response format validation     | ✅ Proper JSON structure     |

## Base Test Class

### BaseE2ETest Features

The `BaseE2ETest` class provides a comprehensive foundation for all E2E tests:

#### HTTP Client Implementation

```php
// Uses cURL for real HTTP requests
protected function makeRequest(string $method, string $endpoint, array $data = [], array $headers = []): array
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->baseUrl . $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $this->formatHeaders($requestHeaders));
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        'status_code' => $httpCode,
        'content' => $response,
        'headers' => $requestHeaders,
    ];
}
```

#### Authentication Management

```php
// Built-in authentication handling
protected function authenticate(string $email, string $password): array
{
    $response = $this->post('/api/security/login', [
        'email' => $email,
        'password' => $password,
    ]);

    $this->assertEquals(200, $response['status_code']);
    $data = $this->getResponseData($response);
    $this->authToken = $data['token'];

    return $data;
}
```

#### Response Validation Methods

```php
// Comprehensive response validation
protected function assertResponseSuccess(array $response, int $expectedStatusCode = 200): void
protected function assertResponseError(array $response, int $expectedStatusCode = 400): void
protected function assertResponseHasToken(array $response): void
protected function assertResponseHasUser(array $response): void
protected function assertResponseContains(array $response, array $expectedData): void
```

#### Test Data Management

```php
// Test data lifecycle management
protected function setUpTestData(): void
protected function cleanupTestData(): void
protected function createTestUser(array $userData = []): array
protected function getTestUserCredentials(): array
protected function getAdminCredentials(): array
```

## Configuration & Setup

### Environment Variables

E2E tests require the following environment variables:

```bash
# Application Configuration
E2E_BASE_URL=http://localhost:8000

# Test User Credentials
E2E_TEST_USER_EMAIL=test@example.com
E2E_TEST_USER_PASSWORD=password123

# Admin User Credentials
E2E_ADMIN_EMAIL=admin@example.com
E2E_ADMIN_PASSWORD=admin123
```

### PHPUnit Configuration

The `phpunit-e2e.xml.dist` file provides specialized configuration for E2E tests:

```xml
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
         cacheDirectory=".phpunit.cache"
         executionOrder="depends,defects"
         requireCoverageMetadata="true"
         beStrictAboutCoverageMetadata="true"
         beStrictAboutOutputDuringTests="true"
         failOnRisky="true"
         failOnWarning="true"
         stopOnFailure="false"
         stopOnError="false"
         stopOnIncomplete="false"
         stopOnSkipped="false">
    <testsuites>
        <testsuite name="E2E Tests">
            <directory>tests/E2E</directory>
        </testsuite>
    </testsuites>

    <php>
        <ini name="error_reporting" value="-1" />
        <ini name="memory_limit" value="-1" />
        <ini name="max_execution_time" value="300" />
        <env name="APP_ENV" value="test" />
        <env name="APP_DEBUG" value="1" />
        <env name="E2E_BASE_URL" value="http://localhost:8000" />
        <env name="E2E_TEST_USER_EMAIL" value="test@example.com" />
        <env name="E2E_TEST_USER_PASSWORD" value="password123" />
        <env name="E2E_ADMIN_EMAIL" value="admin@example.com" />
        <env name="E2E_ADMIN_PASSWORD" value="admin123" />
    </php>
</phpunit>
```

### Prerequisites

1. **Application Server**: The application must be running and accessible
2. **Database**: Test database should be set up with appropriate test data
3. **Email Service**: For password reset tests (if applicable)
4. **Network Access**: Tests need to make HTTP requests to the application

## Running Tests

### Basic Commands

```bash
# Run all E2E tests
./vendor/bin/phpunit -c phpunit-e2e.xml.dist --testdox

# Run specific test suites
./vendor/bin/phpunit -c phpunit-e2e.xml.dist tests/E2E/Security/ --testdox

# Run individual test classes
./vendor/bin/phpunit -c phpunit-e2e.xml.dist tests/E2E/Security/LoginFlowTest.php --testdox

# Run with coverage
./vendor/bin/phpunit -c phpunit-e2e.xml.dist --coverage-html coverage/e2e

# Run with debug output
./vendor/bin/phpunit -c phpunit-e2e.xml.dist --debug

# Run with verbose output
./vendor/bin/phpunit -c phpunit-e2e.xml.dist --verbose
```

### Test Execution Flow

1. **Setup Phase**: `setUp()` method initializes test environment
2. **Test Data Setup**: `setUpTestData()` creates necessary test data
3. **Test Execution**: Individual test methods run with real HTTP requests
4. **Cleanup Phase**: `cleanupTestData()` removes test data
5. **Teardown Phase**: `tearDown()` method cleans up resources

## Test Patterns & Best Practices

### Test Naming Conventions

```php
// Descriptive test names that explain the scenario
public function testSuccessfulLoginFlow(): void
public function testLoginWithInvalidCredentials(): void
public function testPasswordResetWithExpiredToken(): void
public function testPasswordUpdateWithSQLInjectionAttempt(): void
```

### Test Organization

```php
class LoginFlowTest extends BaseE2ETest
{
    // Setup and teardown
    protected function setUp(): void
    protected function tearDown(): void

    // Test data management
    protected function setUpTestData(): void
    protected function cleanupTestData(): void

    // Test methods grouped by functionality
    public function testSuccessfulLoginFlow(): void
    public function testLoginWithInvalidCredentials(): void
    // ... more tests
}
```

### Assertion Patterns

```php
// Use base class assertion methods for consistency
$this->assertResponseSuccess($response);
$this->assertResponseError($response, 401);
$this->assertResponseHasToken($response);
$this->assertResponseHasUser($response);
$this->assertResponseContains($response, ['message' => 'Success']);

// Custom assertions for specific scenarios
$data = $this->getResponseData($response);
$this->assertArrayHasKey('token', $data);
$this->assertEquals($expectedEmail, $data['user']['email']);
```

### Error Handling

```php
// Test both success and failure scenarios
public function testLoginWithInvalidCredentials(): void
{
    $response = $this->post('/api/security/login', [
        'email' => 'nonexistent@example.com',
        'password' => 'wrongpassword',
    ]);

    $this->assertResponseError($response, 401);
    $data = $this->getResponseData($response);
    $this->assertStringContainsString('Invalid credentials', $data['error']);
}
```

## Security Testing

### Attack Simulation

E2E tests include comprehensive security attack simulations:

#### SQL Injection Testing

```php
public function testLoginWithSQLInjectionAttempt(): void
{
    $maliciousCredentials = [
        'email' => "admin'; DROP TABLE users; --",
        'password' => "password' OR '1'='1",
    ];

    $response = $this->post('/api/security/login', $maliciousCredentials);
    $this->assertResponseError($response, 401);
}
```

#### XSS Attack Testing

```php
public function testLoginWithXSSAttempt(): void
{
    $maliciousCredentials = [
        'email' => '<script>alert("xss")</script>@example.com',
        'password' => '<img src=x onerror=alert("xss")>',
    ];

    $response = $this->post('/api/security/login', $maliciousCredentials);
    $this->assertResponseError($response, 400);
}
```

#### Rate Limiting Testing

```php
public function testLoginRateLimiting(): void
{
    $credentials = ['email' => 'test@example.com', 'password' => 'wrongpassword'];

    // Attempt multiple failed logins
    $responses = [];
    for ($i = 0; $i < 10; $i++) {
        $responses[] = $this->post('/api/security/login', $credentials);
    }

    // Should eventually get rate limited
    $rateLimited = false;
    foreach ($responses as $response) {
        if ($response['status_code'] === 429) {
            $rateLimited = true;
            break;
        }
    }

    $this->assertTrue($rateLimited, 'Rate limiting should be triggered');
}
```

### Input Validation Testing

```php
// Test various input formats and edge cases
public function testLoginWithSpecialCharacters(): void
{
    $credentials = [
        'email' => 'test+special@example.com',
        'password' => 'P@ssw0rd!@#$%^&*()',
    ];

    $response = $this->post('/api/security/login', $credentials);
    $this->assertContains($response['status_code'], [200, 401]);
}
```

## Maintenance & Debugging

### Common Issues

#### Connection Refused

```bash
# Ensure application server is running
php -S localhost:8000 -t public
```

#### Authentication Failures

```bash
# Check test user credentials
echo $E2E_TEST_USER_EMAIL
echo $E2E_TEST_USER_PASSWORD
```

#### Database Errors

```bash
# Ensure test database is set up
php bin/console doctrine:database:create --env=test
php bin/console doctrine:migrations:migrate --env=test
```

### Debug Mode

```bash
# Enable debug mode for detailed error information
./vendor/bin/phpunit -c phpunit-e2e.xml.dist --debug

# Get detailed test output
./vendor/bin/phpunit -c phpunit-e2e.xml.dist --verbose

# Run specific test with debug
./vendor/bin/phpunit -c phpunit-e2e.xml.dist tests/E2E/Security/LoginFlowTest.php::testSuccessfulLoginFlow --debug
```

### Test Data Management

```php
// Override in specific test classes
protected function setUpTestData(): void
{
    // Create test users, set up test environment, etc.
    $this->createTestUser([
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);
}

protected function cleanupTestData(): void
{
    // Remove test users, reset test environment, etc.
    // This ensures tests don't interfere with each other
}
```

## Continuous Integration

### GitHub Actions Example

```yaml
name: E2E Tests
on: [push, pull_request]

jobs:
  e2e-tests:
    runs-on: ubuntu-latest

    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_ROOT_PASSWORD: root
          MYSQL_DATABASE: techem_test
        ports:
          - 3306:3306
        options: --health-cmd="mysqladmin ping" --health-interval=10s --health-timeout=5s --health-retries=3

    steps:
      - uses: actions/checkout@v2

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: "8.1"
          extensions: curl, json, mbstring, pdo_mysql

      - name: Install dependencies
        run: composer install --no-progress --prefer-dist --optimize-autoloader

      - name: Setup test database
        run: |
          php bin/console doctrine:database:create --env=test
          php bin/console doctrine:migrations:migrate --env=test
          php bin/console doctrine:fixtures:load --env=test

      - name: Start application server
        run: php -S localhost:8000 -t public &

      - name: Wait for application
        run: sleep 10

      - name: Run E2E tests
        run: ./vendor/bin/phpunit -c phpunit-e2e.xml.dist --testdox
        env:
          E2E_BASE_URL: http://localhost:8000
          E2E_TEST_USER_EMAIL: test@example.com
          E2E_TEST_USER_PASSWORD: password123
          E2E_ADMIN_EMAIL: admin@example.com
          E2E_ADMIN_PASSWORD: admin123
```

### Docker Integration

```dockerfile
# Dockerfile for E2E test environment
FROM php:8.1-cli

RUN apt-get update && apt-get install -y \
    curl \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev

RUN docker-php-ext-install curl pdo_mysql

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
```

## Performance Considerations

### Test Execution Time

- **Individual Tests**: 1-5 seconds per test
- **Full Suite**: 5-10 minutes for all Security tests
- **CI/CD Pipeline**: 10-15 minutes including setup

### Optimization Strategies

1. **Parallel Execution**: Run independent tests in parallel
2. **Test Data Reuse**: Share test data between related tests
3. **Selective Execution**: Run only changed test suites
4. **Caching**: Cache test data and application state

### Resource Requirements

- **Memory**: 256MB minimum, 512MB recommended
- **CPU**: 2 cores minimum for parallel execution
- **Network**: Stable connection for HTTP requests
- **Storage**: 100MB for test data and logs

## Future Enhancements

### Planned Features

1. **Additional Modules**: E2E tests for other application modules
2. **Performance Testing**: Load and stress testing capabilities
3. **Visual Testing**: Screenshot comparison for UI changes
4. **API Contract Testing**: Automated API contract validation
5. **Mobile Testing**: Mobile-specific E2E test scenarios

### Extension Points

```php
// Custom test base classes for specific modules
abstract class ModuleE2ETest extends BaseE2ETest
{
    // Module-specific setup and utilities
}

// Custom assertion methods for specific domains
abstract class SecurityE2ETest extends BaseE2ETest
{
    protected function assertSecurityHeaders(array $response): void
    protected function assertTokenValidity(string $token): void
}
```

## Conclusion

The E2E tests provide comprehensive coverage of the Security module's user-facing functionality, ensuring that:

- **API endpoints work correctly** under real-world conditions
- **User workflows complete successfully** end-to-end
- **Security measures are properly enforced** against actual threats
- **Error handling works as expected** in production-like scenarios
- **Performance is acceptable** under realistic load

The tests follow consistent patterns and are maintainable, making them valuable for:

- **Ongoing development** and feature validation
- **Deployment validation** and rollback decisions
- **Security auditing** and compliance verification
- **Performance monitoring** and optimization
- **Regression prevention** and quality assurance

By implementing these E2E tests, the development team can confidently deploy changes knowing that the core security functionality works correctly from a user's perspective.
