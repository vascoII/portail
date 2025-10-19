# End-to-End (E2E) Tests

## Overview

This directory contains End-to-End tests for the Techem Portail backend application. E2E tests simulate real user interactions with the application by making actual HTTP requests to the API endpoints.

## Test Structure

```
tests/E2E/
├── BaseE2ETest.php           # Base class for all E2E tests
├── Security/                 # Security-related E2E tests
│   ├── LoginFlowTest.php     # User login flow tests
│   ├── PasswordResetFlowTest.php  # Password reset flow tests
│   └── UpdatePasswordFlowTest.php # Password update flow tests
└── README.md                 # This file
```

## Prerequisites

### Environment Setup

1. **Application Server**: The application must be running and accessible
2. **Database**: Test database should be set up with test data
3. **Email Service**: For password reset tests (if applicable)
4. **Environment Variables**: Configure test environment variables

### Required Environment Variables

```bash
# Base URL for the application
E2E_BASE_URL=http://localhost:8000

# Test user credentials
E2E_TEST_USER_EMAIL=test@example.com
E2E_TEST_USER_PASSWORD=password123

# Admin user credentials
E2E_ADMIN_EMAIL=admin@example.com
E2E_ADMIN_PASSWORD=admin123
```

## Running E2E Tests

### Run All E2E Tests

```bash
./vendor/bin/phpunit -c phpunit-e2e.xml.dist --testdox
```

### Run Specific Test Suites

```bash
# Run all Security tests
./vendor/bin/phpunit -c phpunit-e2e.xml.dist tests/E2E/Security/ --testdox

# Run specific test class
./vendor/bin/phpunit -c phpunit-e2e.xml.dist tests/E2E/Security/LoginFlowTest.php --testdox
```

### Run with Coverage

```bash
./vendor/bin/phpunit -c phpunit-e2e.xml.dist --coverage-html coverage/e2e
```

## Test Categories

### Security Tests

#### LoginFlowTest

Tests the complete user login flow including:

- ✅ Successful login with valid credentials
- ❌ Login with invalid credentials
- ❌ Login with missing email/password
- ❌ Login with malformed email
- ❌ Login with weak password
- ❌ Login with special characters
- ❌ Login with unicode characters
- ❌ Login with very long credentials
- ❌ Login with SQL injection attempts
- ❌ Login with XSS attempts
- ❌ Login rate limiting
- ❌ Login with different user types
- ❌ Login response structure validation
- ❌ Login with case-sensitive email
- ❌ Login with whitespace in credentials

#### PasswordResetFlowTest

Tests the password reset flow including:

- ✅ Successful password reset flow
- ❌ Password reset with invalid email
- ❌ Password reset with missing email
- ❌ Password reset with malformed email
- ❌ Password reset with invalid token
- ❌ Password reset with expired token
- ❌ Password reset with mismatched passwords
- ❌ Password reset with weak password
- ❌ Password reset with missing fields
- ❌ Password reset with empty fields
- ❌ Password reset rate limiting
- ❌ Password reset with special characters
- ❌ Password reset with unicode characters
- ❌ Password reset with very long password
- ❌ Password reset with SQL injection attempts
- ❌ Password reset with XSS attempts
- ❌ Password reset token reuse
- ❌ Password reset with whitespace in credentials

#### UpdatePasswordFlowTest

Tests the password update flow including:

- ✅ Successful password update flow
- ❌ Password update without authentication
- ❌ Password update with wrong current password
- ❌ Password update with mismatched new passwords
- ❌ Password update with weak new password
- ❌ Password update with same password
- ❌ Password update with missing fields
- ❌ Password update with empty fields
- ❌ Password update with special characters
- ❌ Password update with unicode characters
- ❌ Password update with very long password
- ❌ Password update with SQL injection attempts
- ❌ Password update with XSS attempts
- ❌ Password update with expired token
- ❌ Password update with invalid token
- ❌ Password update with whitespace in passwords
- ❌ Password update with case-sensitive current password
- ❌ Password update with admin user
- ❌ Password update response structure

## Test Data Management

### Setup and Cleanup

Each test class implements:

- `setUpTestData()`: Sets up test data before tests run
- `cleanupTestData()`: Cleans up test data after tests complete

### Test User Management

The base class provides methods for managing test users:

- `createTestUser()`: Creates a test user with specified data
- `getTestUserCredentials()`: Gets test user credentials from environment
- `getAdminCredentials()`: Gets admin user credentials from environment

## Mocking and Stubbing

E2E tests use minimal mocking to ensure real-world testing:

- **HTTP Client**: Uses real Symfony HTTP client
- **API Endpoints**: Makes actual HTTP requests
- **Database**: Uses real database (test database)
- **Email Service**: May use real email service or test email service

## Security Considerations

### Test Data Security

- Test users should have limited permissions
- Test passwords should be strong but not production-like
- Test data should be isolated from production data

### API Security Testing

- Tests include SQL injection attempts
- Tests include XSS attempts
- Tests include rate limiting scenarios
- Tests include authentication bypass attempts

## Best Practices

### Test Naming

Use descriptive test names that explain the scenario:

```php
public function testSuccessfulLoginFlow(): void
public function testLoginWithInvalidCredentials(): void
public function testPasswordResetWithExpiredToken(): void
```

### Test Organization

- Group related tests in the same test class
- Use consistent naming patterns
- Keep tests focused on single scenarios

### Assertion Patterns

Use the base class assertion methods for consistency:

```php
$this->assertResponseSuccess($response);
$this->assertResponseError($response, 401);
$this->assertResponseHasToken($response);
$this->assertResponseHasUser($response);
```

### Error Handling

- Test both success and failure scenarios
- Verify proper error messages and status codes
- Test edge cases and boundary conditions

## Troubleshooting

### Common Issues

1. **Connection Refused**: Ensure the application server is running
2. **Authentication Failures**: Check test user credentials
3. **Database Errors**: Ensure test database is set up correctly
4. **Timeout Issues**: Increase timeout values for slow operations

### Debug Mode

Enable debug mode for detailed error information:

```bash
./vendor/bin/phpunit -c phpunit-e2e.xml.dist --debug
```

### Verbose Output

Get detailed test output:

```bash
./vendor/bin/phpunit -c phpunit-e2e.xml.dist --verbose
```

## Continuous Integration

### GitHub Actions Example

```yaml
name: E2E Tests
on: [push, pull_request]
jobs:
  e2e-tests:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: "8.1"
      - name: Install dependencies
        run: composer install
      - name: Start application
        run: php -S localhost:8000 -t public &
      - name: Run E2E tests
        run: ./vendor/bin/phpunit -c phpunit-e2e.xml.dist
        env:
          E2E_BASE_URL: http://localhost:8000
```

## Maintenance

### Adding New Tests

1. Create test class extending `BaseE2ETest`
2. Follow naming conventions
3. Use consistent test patterns
4. Include comprehensive scenarios
5. Update this documentation

### Updating Existing Tests

1. Maintain backward compatibility when possible
2. Update test data when API changes
3. Add new test scenarios for new features
4. Remove obsolete tests when functionality is removed

### Debugging Failed Tests

1. Check application server status
2. Verify test user credentials
3. Check database connectivity
4. Review application logs
5. Use debug mode for detailed output

## Conclusion

E2E tests provide comprehensive coverage of the application's user-facing functionality, ensuring that:

- API endpoints work correctly under real conditions
- User flows complete successfully
- Error handling works as expected
- Security measures are properly enforced
- Performance is acceptable

The tests follow consistent patterns and are maintainable, making them valuable for ongoing development and deployment validation.
