# Unit Tests for UseCase Classes

This directory contains comprehensive unit tests for the UseCase classes in the clean architecture backend.

## Test Structure

```
tests/Unit/Application/UseCase/
├── BaseUseCaseTest.php              # Base test class with common utilities
├── Operator/                        # Operator-related UseCase tests
│   ├── CreateOperatorUseCaseTest.php
│   ├── GetOperatorUseCaseTest.php
│   ├── DeleteUseCaseTest.php
│   └── ListOperatorsUseCaseTest.php
├── Occupant/                        # Occupant-related UseCase tests
│   └── GetOccupantUseCaseTest.php
├── Ticket/                          # Ticket-related UseCase tests
│   └── CreateTicketUseCaseTest.php
├── Logement/                        # Logement-related UseCase tests
│   └── GetLogementUseCaseTest.php
├── Immeuble/                        # Immeuble-related UseCase tests
│   └── GetImmeubleUseCaseTest.php
└── Security/                        # Security-related UseCase tests
    └── LoginUseCaseTest.php
```

## Test Patterns

All UseCase tests follow a consistent pattern:

### 1. Basic Structure

- Extend `BaseUseCaseTest` for common utilities
- Mock the DataProvider interface
- Test the `execute()` method behavior

### 2. Test Methods

Each test class typically includes:

- `testExecuteReturnsCorrectOutput()` - Verifies return type and value
- `testExecuteCallsDataProviderWithCorrectInput()` - Verifies data provider interaction
- `testExecuteWithDifferentInput()` - Tests with various input scenarios

### 3. Mocking Strategy

- **DataProvider interfaces**: Mocked using Mockery
- **Final DTO classes**: Mocked using PHPUnit's `createMock()`
- **Input DTOs**: Created as real instances with test data

## Running Tests

### Run All UseCase Tests

```bash
./vendor/bin/phpunit tests/Unit/Application/UseCase/
```

### Run Specific Test Suite

```bash
./vendor/bin/phpunit tests/Unit/Application/UseCase/Operator/
```

### Run Individual Test

```bash
./vendor/bin/phpunit tests/Unit/Application/UseCase/Operator/CreateOperatorUseCaseTest.php
```

### Run with Coverage

```bash
./vendor/bin/phpunit --coverage-html coverage-report tests/Unit/Application/UseCase/
```

## Test Coverage

The tests cover:

- ✅ UseCase execution flow
- ✅ DataProvider method calls
- ✅ Input parameter validation
- ✅ Output type verification
- ✅ Error handling scenarios

## Common Patterns

### Testing Success Cases

```php
public function testExecuteReturnsCorrectOutput(): void
{
    // Arrange
    $inputDto = new SomeInputDto(/* test data */);
    $expectedOutput = $this->createMock(SomeOutputDto::class);

    $this->dataProvider
        ->shouldReceive('someMethod')
        ->with($inputDto)
        ->once()
        ->andReturn($expectedOutput);

    // Act
    $result = $this->useCase->execute($inputDto);

    // Assert
    $this->assertInstanceOf(SomeOutputDto::class, $result);
    $this->assertEquals($expectedOutput, $result);
}
```

### Testing DataProvider Interaction

```php
public function testExecuteCallsDataProviderWithCorrectInput(): void
{
    // Arrange
    $inputDto = new SomeInputDto(/* test data */);
    $expectedOutput = $this->createMock(SomeOutputDto::class);

    $this->dataProvider
        ->shouldReceive('someMethod')
        ->with($inputDto)
        ->once()
        ->andReturn($expectedOutput);

    // Act
    $this->useCase->execute($inputDto);

    // Assert
    $this->assertMethodCalledOnce($this->dataProvider, 'someMethod', $inputDto);
}
```

## Best Practices

1. **Use descriptive test names** that explain what is being tested
2. **Follow AAA pattern** (Arrange, Act, Assert)
3. **Mock external dependencies** but test real business logic
4. **Test both success and failure scenarios**
5. **Keep tests independent** - each test should be able to run in isolation
6. **Use meaningful test data** that represents real-world scenarios

## Troubleshooting

### Common Issues

1. **Final class mocking errors**: Use `$this->createMock()` instead of `Mockery::mock()` for final classes
2. **Missing assertions**: Ensure each test has proper assertions
3. **Mock setup issues**: Verify that mock expectations match actual method calls

### Debugging Tests

Add debug output to understand test failures:

```php
// In test method
var_dump($result);
$this->assertTrue(false, 'Debug: ' . print_r($result, true));
```

## Future Enhancements

- Add integration tests for DataProvider implementations
- Implement test data factories for complex DTOs
- Add performance tests for critical UseCases
- Expand error scenario coverage
