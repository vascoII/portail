# 🧪 Testing Strategy for Clean Architecture Backend

## Overview

This document outlines the comprehensive testing strategy for our clean architecture backend. The strategy follows the testing pyramid approach with a focus on maintainable, reliable, and fast tests.

## 🏗️ Testing Pyramid Structure

```
    🔺 E2E Tests (Few)
   🔺🔺 Integration Tests (Some)
  🔺🔺🔺 Unit Tests (Many)
```

## 1. Unit Tests (Priority #1)

### What to Test

- **Use Cases** - Business logic validation
- **DTOs** - Data validation and transformation
- **Transformers** - Data mapping logic
- **Hydrators** - Request/response serialization
- **Validators** - Input validation rules

### Directory Structure

```
tests/Unit/
├── Application/
│   ├── UseCase/
│   │   ├── Security/
│   │   │   ├── LoginUseCaseTest.php
│   │   │   ├── LoginFromParamUseCaseTest.php
│   │   │   ├── ResetPasswordUseCaseTest.php
│   │   │   └── UpdatePasswordUseCaseTest.php
│   │   ├── Operator/
│   │   │   ├── GetOperatorStatUseCaseTest.php
│   │   │   ├── CreateOperationImmeubleUseCaseTest.php
│   │   │   └── PatchOperatorImmeubleUseCaseTest.php
│   │   ├── Parc/
│   │   │   ├── GetParcUseCaseTest.php
│   │   │   ├── ListParcInterventionsUseCaseTest.php
│   │   │   └── GetParcIndicatorsUseCaseTest.php
│   │   └── Occupant/
│   │       ├── GetOccupantReleveEauUseCaseTest.php
│   │       ├── GetOccupantReleveNoteUseCaseTest.php
│   │       └── GetOccupantInterventionUseCaseTest.php
│   ├── Dto/
│   │   ├── Input/
│   │   │   ├── Security/LoginInputDtoTest.php
│   │   │   └── Shared/GetByIdIntInputDtoTest.php
│   │   └── Output/
│   │       ├── Security/LoginOutputDtoTest.php
│   │       └── Shared/SuccessOutputDtoTest.php
│   └── Service/
│       └── Transformer/
│           ├── SecurityTransformerTest.php
│           ├── OperatorTransformerTest.php
│           └── ParcTransformerTest.php
└── Infrastructure/
    ├── Service/
    │   ├── Hydrator/
    │   │   ├── SecurityHydratorTest.php
    │   │   └── OperatorHydratorTest.php
    │   └── Transformer/
    │       ├── SecurityTransformerTest.php
    │       └── OperatorTransformerTest.php
    └── Factory/
        └── Operator/
            └── OperatorInputFactoryTest.php
```

### Key Principles

- Mock all dependencies
- Test one class at a time
- Focus on business logic
- Aim for 80-90% coverage

### Example Unit Test

```php
<?php

namespace Tests\Unit\Application\UseCase\Security;

use App\Application\UseCase\Security\LoginUseCase;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use PHPUnit\Framework\TestCase;
use Mockery;

class LoginUseCaseTest extends TestCase
{
    private SecurityDataProviderInterface $dataProvider;
    private LoginUseCase $useCase;

    protected function setUp(): void
    {
        $this->dataProvider = Mockery::mock(SecurityDataProviderInterface::class);
        $this->useCase = new LoginUseCase($this->dataProvider);
    }

    public function testExecuteReturnsLoginOutputDto(): void
    {
        // Arrange
        $inputDto = new LoginInputDto('test@example.com', 'password');
        $expectedOutput = new LoginOutputDto(/* ... */);

        $this->dataProvider
            ->shouldReceive('loginService')
            ->with($inputDto)
            ->once()
            ->andReturn($expectedOutput);

        // Act
        $result = $this->useCase->execute($inputDto);

        // Assert
        $this->assertInstanceOf(LoginOutputDto::class, $result);
        $this->assertEquals($expectedOutput, $result);
    }
}
```

## 2. Integration Tests (Priority #2)

### What to Test

- **DataProvider** implementations
- **DataSource** SOAP integrations
- **Database** interactions (if any)
- **Cache** operations
- **Authentication** flows

### Directory Structure

```
tests/Integration/
├── Service/
│   ├── DataProvider/
│   │   ├── SecurityDataProviderTest.php
│   │   ├── OperatorDataProviderTest.php
│   │   └── ParcDataProviderTest.php
│   └── DataSource/
│       ├── SecuritySoapTest.php
│       ├── OperatorSoapTest.php
│       └── ParcSoapTest.php
└── Http/
    └── Action/
        ├── Security/
        │   ├── LoginActionTest.php
        │   └── ResetPasswordActionTest.php
        ├── Operator/
        │   ├── GetOperatorStatActionTest.php
        │   └── CreateOperationImmeubleActionTest.php
        └── Parc/
            ├── GetParcActionTest.php
            └── ListParcInterventionsActionTest.php
```

### Key Principles

- Use real implementations with mocked external dependencies
- Test data flow between layers
- Use test databases/APIs when possible

### Example Integration Test

```php
<?php

namespace Tests\Integration\Service\DataProvider;

use App\Infrastructure\Service\DataProvider\SecurityDataProvider;
use App\Application\Service\DataSource\SecurityDataSourceInterface;
use App\Application\Service\Transformer\SecurityTransformerInterface;
use App\Application\Dto\Input\Security\LoginInputDto;
use PHPUnit\Framework\TestCase;
use Mockery;

class SecurityDataProviderTest extends TestCase
{
    private SecurityDataSourceInterface $dataSource;
    private SecurityTransformerInterface $transformer;
    private SecurityDataProvider $dataProvider;

    protected function setUp(): void
    {
        $this->dataSource = Mockery::mock(SecurityDataSourceInterface::class);
        $this->transformer = Mockery::mock(SecurityTransformerInterface::class);
        $this->dataProvider = new SecurityDataProvider($this->dataSource, $this->transformer);
    }

    public function testLoginServiceIntegratesCorrectly(): void
    {
        // Arrange
        $inputDto = new LoginInputDto('test@example.com', 'password');
        $rawData = (object) ['User' => [], 'SessionID' => '123'];
        $expectedOutput = new LoginOutputDto(/* ... */);

        $this->dataSource
            ->shouldReceive('fetchLogin')
            ->with($inputDto)
            ->once()
            ->andReturn($rawData);

        $this->transformer
            ->shouldReceive('transformLogin')
            ->with($rawData)
            ->once()
            ->andReturn($expectedOutput);

        // Act
        $result = $this->dataProvider->loginService($inputDto);

        // Assert
        $this->assertEquals($expectedOutput, $result);
    }
}
```

## 3. End-to-End Tests (Priority #3)

### What to Test

- **Complete API workflows**
- **Authentication flows**
- **Critical business scenarios**

### Directory Structure

```
tests/E2E/
├── Security/
│   ├── LoginFlowTest.php
│   ├── PasswordResetFlowTest.php
│   └── UpdatePasswordFlowTest.php
├── Operator/
│   ├── OperatorManagementFlowTest.php
│   ├── OperatorImmeubleOperationsTest.php
│   └── OperatorStatsFlowTest.php
├── Parc/
│   ├── ParcDataRetrievalTest.php
│   └── ParcIndicatorsFlowTest.php
└── Occupant/
    ├── OccupantReleveFlowTest.php
    └── OccupantInterventionFlowTest.php
```

### Example E2E Test

```php
<?php

namespace Tests\E2E\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginFlowTest extends WebTestCase
{
    public function testCompleteLoginFlow(): void
    {
        $client = static::createClient();

        // Test login endpoint
        $client->request('POST', '/security/login', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'email' => 'test@example.com',
            'password' => 'password123'
        ]));

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $responseData);
        $this->assertArrayHasKey('user', $responseData);
    }
}
```

## 4. Testing Tools & Framework

### Recommended Stack

```bash
# PHPUnit for unit/integration tests
composer require --dev phpunit/phpunit

# Pest for more readable tests (optional)
composer require --dev pestphp/pest

# Mockery for mocking
composer require --dev mockery/mockery

# HTTP testing
composer require --dev symfony/http-client

# Database testing (if needed)
composer require --dev doctrine/doctrine-fixtures-bundle
```

### PHPUnit Configuration

```xml
<!-- phpunit.xml -->
<phpunit>
    <testsuites>
        <testsuite name="Unit">
            <directory>tests/Unit</directory>
        </testsuite>
        <testsuite name="Integration">
            <directory>tests/Integration</directory>
        </testsuite>
        <testsuite name="E2E">
            <directory>tests/E2E</directory>
        </testsuite>
    </testsuites>
    <coverage>
        <include>
            <directory suffix=".php">src/Application</directory>
            <directory suffix=".php">src/Infrastructure</directory>
        </include>
        <exclude>
            <directory>src/Http</directory>
        </exclude>
    </coverage>
</phpunit>
```

## 5. Test Data Management

### Factories

```php
// tests/Factories/UserFactory.php
class UserFactory
{
    public static function create(array $attributes = []): User
    {
        return new User(
            email: $attributes['email'] ?? 'test@example.com',
            firstName: $attributes['firstName'] ?? 'John',
            lastName: $attributes['lastName'] ?? 'Doe',
            // ... other attributes
        );
    }

    public static function createMany(int $count, array $attributes = []): array
    {
        return collect(range(1, $count))
            ->map(fn() => self::create($attributes))
            ->toArray();
    }
}
```

### Fixtures

```json
// tests/Fixtures/security_data.json
{
  "validLogin": {
    "email": "test@example.com",
    "password": "password123"
  },
  "invalidLogin": {
    "email": "invalid@example.com",
    "password": "wrongpassword"
  }
}
```

## 6. Mocking Strategy

### External Dependencies

```php
// Mock SOAP clients
$mockSoapClient = $this->createMock(SoapClient::class);

// Mock Redis
$mockRedis = $this->createMock(RedisService::class);

// Mock JWT service
$mockJwt = $this->createMock(JwtService::class);

// Mock authentication service
$mockAuth = $this->createMock(AuthServiceInterface::class);
```

### Service Container Testing

```php
// tests/Integration/ServiceContainerTest.php
class ServiceContainerTest extends WebTestCase
{
    public function testServicesAreRegistered(): void
    {
        $container = static::getContainer();

        $this->assertTrue($container->has(SecurityDataProviderInterface::class));
        $this->assertTrue($container->has(OperatorDataProviderInterface::class));
        $this->assertTrue($container->has(ParcDataProviderInterface::class));
    }
}
```

## 7. CI/CD Integration

### GitHub Actions

```yaml
# .github/workflows/tests.yml
name: Tests
on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v3

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: "8.2"
          extensions: mbstring, xml, ctype, iconv, intl, pdo_sqlite

      - name: Install dependencies
        run: composer install --prefer-dist --no-progress

      - name: Run unit tests
        run: ./vendor/bin/phpunit --testsuite=Unit --coverage-clover=coverage-unit.xml

      - name: Run integration tests
        run: ./vendor/bin/phpunit --testsuite=Integration --coverage-clover=coverage-integration.xml

      - name: Run E2E tests
        run: ./vendor/bin/phpunit --testsuite=E2E

      - name: Generate coverage report
        run: |
          ./vendor/bin/phpunit --coverage-html coverage-report

      - name: Upload coverage to Codecov
        uses: codecov/codecov-action@v3
        with:
          files: coverage-unit.xml,coverage-integration.xml
```

## 8. Testing Best Practices

### ✅ Do

- Test behavior, not implementation
- Use descriptive test names
- Follow AAA pattern (Arrange, Act, Assert)
- Keep tests independent
- Use data providers for multiple scenarios
- Mock external dependencies
- Test edge cases and error conditions
- Use factories for test data creation
- Test one thing at a time
- Write tests before fixing bugs (TDD)

### ❌ Don't

- Test private methods directly
- Test framework code
- Write tests that depend on each other
- Mock everything (test real integrations)
- Ignore error scenarios
- Write overly complex tests
- Test implementation details
- Skip assertions in tests

## 9. Specific Recommendations for Our Architecture

### High Priority Tests

1. **Security Use Cases** - Authentication is critical
2. **Operator Management** - Business logic validation
3. **Data Transformation** - Ensure data integrity
4. **SOAP Integration** - External API reliability

### Test Coverage Goals

- **Unit Tests**: 80-90% coverage
- **Integration Tests**: 60-70% coverage
- **E2E Tests**: 20-30% coverage

### Implementation Order

1. **Start with Unit Tests** for Use Cases
2. **Add Integration Tests** for DataProviders
3. **Create E2E Tests** for critical user flows
4. **Expand coverage** based on business priorities

## 10. Running Tests

### Commands

```bash
# Run all tests
./vendor/bin/phpunit

# Run specific test suite
./vendor/bin/phpunit --testsuite=Unit
./vendor/bin/phpunit --testsuite=Integration
./vendor/bin/phpunit --testsuite=E2E

# Run with coverage
./vendor/bin/phpunit --coverage-html coverage-report

# Run specific test
./vendor/bin/phpunit tests/Unit/Application/UseCase/Security/LoginUseCaseTest.php

# Run tests in watch mode (if using Pest)
./vendor/bin/pest --watch
```

### Test Database Setup

```bash
# Create test database
php bin/console doctrine:database:create --env=test

# Run migrations
php bin/console doctrine:migrations:migrate --env=test

# Load fixtures
php bin/console doctrine:fixtures:load --env=test
```

## 11. Performance Considerations

### Test Performance

- Unit tests should run in < 1ms each
- Integration tests should run in < 100ms each
- E2E tests should run in < 1s each
- Total test suite should complete in < 5 minutes

### Optimization Tips

- Use in-memory databases for tests
- Mock external API calls
- Run tests in parallel when possible
- Use test data builders instead of fixtures for complex objects

## 12. Maintenance

### Regular Tasks

- Review and update test coverage monthly
- Refactor tests when business logic changes
- Remove obsolete tests
- Update test data and fixtures
- Monitor test performance

### Code Review Checklist

- [ ] New features have corresponding tests
- [ ] Tests follow naming conventions
- [ ] Tests are independent and isolated
- [ ] Edge cases are covered
- [ ] Error scenarios are tested
- [ ] Test data is realistic and maintainable

---

## Quick Start

1. **Install dependencies:**

   ```bash
   composer require --dev phpunit/phpunit mockery/mockery
   ```

2. **Create your first test:**

   ```bash
   mkdir -p tests/Unit/Application/UseCase/Security
   ```

3. **Run tests:**

   ```bash
   ./vendor/bin/phpunit
   ```

4. **Check coverage:**
   ```bash
   ./vendor/bin/phpunit --coverage-html coverage-report
   ```

This testing strategy will ensure your clean architecture backend is robust, maintainable, and reliable! 🚀
