# Integration Tests Documentation

## Overview

This document describes the integration tests for the Techem Portail backend application. The integration tests focus on testing the interaction between multiple components of the application, particularly the Http/Action layer, DataProvider layer, and their dependencies.

## Test Structure

### Directory Organization

```
tests/Integration/
├── Http/Action/           # HTTP Action integration tests
│   ├── Security/          # Authentication & authorization actions
│   ├── Operator/          # Operator management actions
│   ├── Parc/             # Parc management actions
│   ├── Immeuble/         # Building management actions
│   ├── Logement/         # Apartment management actions
│   ├── Occupant/         # Occupant management actions
│   └── Ticket/           # Ticket management actions
└── Service/DataProvider/  # DataProvider integration tests
    ├── Security/         # Security data operations
    ├── Operator/         # Operator data operations
    ├── Parc/            # Parc data operations
    ├── Immeuble/        # Building data operations
    ├── Logement/        # Apartment data operations
    ├── Occupant/        # Occupant data operations
    └── Ticket/          # Ticket data operations
```

## Http/Action Integration Tests

### Purpose

The Http/Action integration tests verify that HTTP requests are properly handled by the Action classes, including:

- Request parsing and validation
- UseCase invocation with correct parameters
- Response generation through ResponderInterface
- Error handling and status codes
- Authentication and authorization

### Base Test Class

All Http/Action tests extend `BaseActionTest` which provides:

```php
abstract class BaseActionTest extends TestCase
{
    // Common setup methods
    protected function createResponderMock(): MockInterface
    protected function createUseCaseMock(string $useCaseClass): MockInterface
    protected function createFactoryMock(string $factoryClass): MockInterface

    // Request creation helpers
    protected function createRequest(string $method, string $uri, array $parameters = [], array $content = [])
    protected function createAuthenticatedRequest(string $method, string $uri, string $token = 'valid_token')
    protected function createQueryRequest(string $uri)

    // Response assertion helpers
    protected function assertResponseSuccess(Response $response)
    protected function assertResponseClientError(Response $response)
    protected function assertResponseServerError(Response $response)
    protected function assertJsonResponse(Response $response)
}
```

### Test Categories

#### 1. Security Actions

**LoginAction Tests:**

- Valid credentials authentication
- Invalid credentials handling
- Missing credentials validation
- Different user types (admin, user, etc.)
- Malformed JSON handling
- Special characters in credentials
- Long credentials handling

**LogoutAction Tests:**

- Valid session logout
- Invalid session handling
- Expired token scenarios
- Malformed token handling
- Empty token validation
- Missing authorization header
- Different HTTP methods support

#### 2. Operator Actions

**ListOperatorsAction Tests:**

- Valid request with operators list
- Query parameters (pagination, search, sorting)
- Empty results handling
- Unauthorized access
- Invalid token scenarios
- Custom headers support

#### 3. Parc Actions

**GetParcAction Tests:**

- Valid parc retrieval
- Unauthorized access handling
- Invalid token scenarios
- Query parameters support
- Empty results (not found)
- Different HTTP methods
- Custom headers
- Route arguments
- Server error scenarios
- Large dataset handling

#### 4. Immeuble Actions

**GetImmeubleAction Tests:**

- Valid building retrieval with complete DTO
- Unauthorized access handling
- Invalid token scenarios
- Query parameters support
- Empty results handling
- Different HTTP methods
- Custom headers
- Route arguments
- Server error scenarios
- Large dataset handling

**ListImmeublesAction Tests:**

- Valid buildings list retrieval
- Unauthorized access handling
- Invalid token scenarios
- Query parameters (city, type, pagination)
- Empty results handling
- Different HTTP methods
- Custom headers
- Route arguments
- Server error scenarios
- Large dataset handling

### Test Patterns

Each action test follows a consistent pattern:

1. **Arrange:** Set up mocks, create test data, configure expectations
2. **Act:** Invoke the action with test request
3. **Assert:** Verify response status, content, and mock interactions

Example test structure:

```php
public function testActionWithValidRequest(): void
{
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/endpoint');
    $outputDto = new OutputDto(/* test data */);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
        ->shouldReceive('createFromRequest')
        ->once()
        ->with($request)
        ->andReturn($inputDto);

    $this->useCase
        ->shouldReceive('execute')
        ->once()
        ->with($inputDto)
        ->andReturn($outputDto);

    $this->responder
        ->shouldReceive('respond')
        ->with($outputDto)
        ->once()
        ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request);

    // Assert
    $this->assertResponseSuccess($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
}
```

## DataProvider Integration Tests

### Purpose

The DataProvider integration tests verify the interaction between:

- DataProvider services
- DataSource services (SOAP, API calls)
- Transformer services
- Cache services (Redis)
- Authentication services

### Base Test Class

All DataProvider tests extend `BaseDataProviderTest` which provides:

```php
abstract class BaseDataProviderTest extends TestCase
{
    // Service mocks
    protected AuthServiceInterface $authService;
    protected DataSourceInterface $dataSource;
    protected TransformerInterface $transformer;
    protected JwtServiceInterface $jwtService;
    protected RedisServiceInterface $redisService;
    protected RedisService $cache;

    // Mock creation methods
    protected function createAuthServiceMock(): MockInterface
    protected function createDataSourceMock(): MockInterface
    protected function createTransformerMock(): MockInterface
    protected function createJwtServiceMock(): MockInterface
    protected function createRedisServiceMock(): MockInterface
    protected function createCacheServiceMock(): MockInterface

    // Test data helpers
    protected function createDataSourceResult(array $data): object
    protected function createTestAuthContext(): object
    protected function createTestUserDto(): object
    protected function createTestSessionDto(): object
}
```

### Test Categories

#### 1. Security DataProvider

Tests authentication and authorization data operations:

- Login service with valid credentials
- Logout service with session management
- Password reset functionality
- JWT token generation and validation
- Session management

#### 2. Operator DataProvider

Tests operator data management:

- List operators with caching
- Create operator operations
- Update operator information
- Delete operator functionality
- Cache integration and invalidation

#### 3. Parc DataProvider

Tests parc (property portfolio) data operations:

- Get parc information
- Get parc indicators
- Get parc consumption data (CET, EC, EF, Elect, Gaz)
- Data transformation and caching

#### 4. Immeuble DataProvider

Tests building data operations:

- Get building information
- Get building indicators
- Get building consumption data
- List buildings with filtering

#### 5. Logement DataProvider

Tests apartment data operations:

- Get apartment information
- Get apartment indicators
- Get apartment consumption data
- List apartments with filtering

#### 6. Occupant DataProvider

Tests occupant data operations:

- Get occupant information
- List occupants with filtering
- Occupant account management

#### 7. Ticket DataProvider

Tests ticket/support data operations:

- Get ticket information
- List tickets with filtering
- Ticket status management

## Mocking Strategy

### Handling Final Classes

The application uses many `final` classes that cannot be mocked directly. We use Mockery's `alias` feature:

```php
// For final classes
protected function createCacheServiceMock(): MockInterface
{
    return Mockery::mock('alias:App\Infrastructure\Service\Redis\RedisService');
}

protected function createUseCaseMock(string $useCaseClass): MockInterface
{
    return Mockery::mock('alias:' . $useCaseClass);
}
```

### DTO Constructor Handling

Many DTOs have complex constructors with many parameters. We ensure all required parameters are provided:

```php
$outputDto = new GetImmeubleOutputDto(
    1,                              // pkImmeuble
    'Test Building',                // nom
    'A test building',              // numero
    'REF123',                       // ref
    '123 Main St',                  // adresse1
    'Suite 100',                    // adresse2
    'Building A',                   // adresse3
    '12345',                        // cp
    'City',                         // ville
    true,                           // hasTelereleve
    1,                              // fkClientTop
    true,                           // actif
    new \DateTimeImmutable('2024-01-01'), // dateActivationClient
    new \DateTimeImmutable('2024-01-01'), // dateActivationOccupant
    true,                           // hasNoteOccupant
    true,                           // hasDecompteOccupant
    true,                           // hasFactures
    true                            // hasChantiers
);
```

## Running Tests

### Run All Integration Tests

```bash
./vendor/bin/phpunit tests/Integration/ --testdox
```

### Run Specific Test Suites

```bash
# Http/Action tests
./vendor/bin/phpunit tests/Integration/Http/Action/ --testdox

# DataProvider tests
./vendor/bin/phpunit tests/Integration/Service/DataProvider/ --testdox

# Specific action tests
./vendor/bin/phpunit tests/Integration/Http/Action/Security/ --testdox
./vendor/bin/phpunit tests/Integration/Http/Action/Operator/ --testdox
```

### Run Individual Test Classes

```bash
./vendor/bin/phpunit tests/Integration/Http/Action/Security/LoginActionTest.php --testdox
./vendor/bin/phpunit tests/Integration/Service/DataProvider/SecurityDataProviderTest.php --testdox
```

## Test Coverage

### Current Status

- **Http/Action Tests:** 86 tests total

  - ✅ **56 tests passing** (65%)
  - ❌ **30 tests failing** (35%)

- **DataProvider Tests:** 70 tests total
  - ✅ **70 tests passing** (100%)

### Passing Test Suites

1. **GetParcAction** (10/10 tests) ✅
2. **ListImmeublesAction** (10/10 tests) ✅
3. **GetImmeubleAction** (10/10 tests) ✅
4. **ListOperatorsAction** (9/9 tests) ✅
5. **LoginAction** (8/8 tests) ✅
6. **LogoutAction** (9/9 tests) ✅
7. **All DataProvider tests** (70/70 tests) ✅

### Tests Needing Fixes

1. **GetLogementAction** (10 tests) - Missing SharedInputFactory dependency
2. **GetOccupantAction** (10 tests) - Missing SharedInputFactory and proper entity mocking
3. **GetTicketAction** (10 tests) - Missing SharedInputFactory dependency

## Best Practices

### 1. Test Naming

Use descriptive test names that explain the scenario:

```php
public function testGetImmeubleWithValidRequest(): void
public function testGetImmeubleWithUnauthorizedRequest(): void
public function testGetImmeubleWithQueryParameters(): void
public function testGetImmeubleWithLargeDataset(): void
```

### 2. Test Organization

Group related tests in the same test class and use consistent naming patterns.

### 3. Mock Expectations

Always set up proper mock expectations:

```php
$this->inputFactory
    ->shouldReceive('getIdIntFromRoute')
    ->once()
    ->with($request)
    ->andReturn(1);

$this->useCase
    ->shouldReceive('execute')
    ->once()
    ->with(1)
    ->andReturn($outputDto);
```

### 4. Assertion Patterns

Use the base class assertion methods for consistency:

```php
$this->assertResponseSuccess($response);
$this->assertJsonResponse($response);
$this->assertEquals($expectedResponse, $response);
```

### 5. Test Data

Use realistic test data that matches the expected DTO structure:

```php
$outputDto = new GetImmeubleOutputDto(
    // Use realistic values that match the business domain
    1, 'Test Building', 'A test building for demonstration',
    'REF123', '123 Main St', 'Suite 100', 'Building A',
    '12345', 'City', true, 1, true,
    new \DateTimeImmutable('2024-01-01'),
    new \DateTimeImmutable('2024-01-01'),
    true, true, true, true
);
```

## Maintenance

### Adding New Tests

1. Create test class extending appropriate base class
2. Follow naming conventions
3. Use consistent test patterns
4. Include comprehensive scenarios (success, failure, edge cases)
5. Update this documentation

### Updating Existing Tests

1. Maintain backward compatibility when possible
2. Update test data when DTOs change
3. Add new test scenarios for new features
4. Remove obsolete tests when functionality is removed

### Debugging Failed Tests

1. Check mock expectations are properly set up
2. Verify DTO constructor arguments match current implementation
3. Ensure all dependencies are properly mocked
4. Check for changes in Action constructor signatures

## Conclusion

The integration tests provide comprehensive coverage of the application's HTTP and data layers, ensuring that:

- API endpoints work correctly under various conditions
- Data operations integrate properly with external services
- Error handling works as expected
- Authentication and authorization are properly enforced
- Caching mechanisms function correctly

The tests follow consistent patterns and are maintainable, making them valuable for ongoing development and refactoring efforts.
