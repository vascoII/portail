# DTO Unit Testing Implementation

This directory contains comprehensive unit tests for the Data Transfer Objects (DTOs) in the clean architecture backend.

## Overview

DTOs are simple data containers that transfer data between different layers of the application. Testing DTOs ensures:

- **Data integrity**: Properties are correctly set and retrieved
- **Immutability**: DTOs cannot be modified after creation
- **Type safety**: Correct data types are enforced
- **Contract compliance**: DTOs follow expected patterns

## Test Structure

```
tests/Unit/Application/Dto/
├── BaseDtoTest.php                    # Base test class with common utilities
├── Input/                            # Input DTO tests
│   ├── Shared/
│   │   ├── GetByIdIntInputDtoTest.php
│   │   └── GetReportInputDtoTest.php
│   ├── Operator/
│   │   └── CreateOperatorInputDtoTest.php
│   ├── Security/
│   │   └── LoginInputDtoTest.php
│   └── Logement/
│       └── SetSeuilConsoInputDtoTest.php
└── Output/                           # Output DTO tests
    └── Shared/
        ├── SuccessOutputDtoTest.php
        └── UserDtoTest.php
```

## DTO Categories Tested

### 1. **Simple DTOs**

- `GetByIdIntInputDto` - Single integer parameter
- `SuccessOutputDto` - Simple boolean response

### 2. **Complex Input DTOs**

- `CreateOperatorInputDto` - User creation with multiple fields
- `LoginInputDto` - Authentication data
- `GetReportInputDto` - Report generation parameters
- `SetSeuilConsoInputDto` - Configuration parameters

### 3. **Complex Output DTOs**

- `UserDto` - Complex user data with many nullable fields

## Test Patterns

### Base Test Class Features

The `BaseDtoTest` class provides common utilities:

```php
// Assert DTO has expected properties with correct values
$this->assertDtoProperties($dto, $expectedProperties);

// Assert DTO has expected properties (without checking values)
$this->assertDtoHasProperties($dto, $expectedProperties);

// Assert all DTO properties are readonly
$this->assertDtoPropertiesAreReadonly($dto);

// Assert DTO is immutable (no setters)
$this->assertDtoIsImmutable($dto);

// Assert constructor requires all parameters
$this->assertDtoConstructorRequiresAllParameters($dtoClass, $expectedParameters);
```

### Common Test Methods

Each DTO test typically includes:

1. **Constructor Tests**

   - `testConstructorSetsAllProperties()` - Verifies properties are set correctly
   - `testConstructorRequiresAllParameters()` - Ensures all parameters are required

2. **Property Tests**

   - `testDtoHasExpectedProperties()` - Verifies all expected properties exist
   - `testDtoPropertiesAreReadonly()` - Ensures properties are readonly

3. **Immutability Tests**

   - `testDtoIsImmutable()` - Verifies no setter methods exist

4. **Data Validation Tests**

   - `testWithValidData()` - Tests with valid input
   - `testWithEmptyValues()` - Tests with empty/null values
   - `testWithSpecialCharacters()` - Tests with special characters

5. **Type Safety Tests**
   - `testDtoIsFinalClass()` - Ensures DTO is final (if applicable)

## Example Test

```php
<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Dto\Input\Shared;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Tests\Unit\Application\Dto\BaseDtoTest;

class GetByIdIntInputDtoTest extends BaseDtoTest
{
    public function testConstructorSetsIdProperty(): void
    {
        // Arrange
        $id = 123;

        // Act
        $dto = new GetByIdIntInputDto($id);

        // Assert
        $this->assertEquals($id, $dto->id);
    }

    public function testDtoHasExpectedProperties(): void
    {
        // Arrange
        $dto = new GetByIdIntInputDto(456);

        // Assert
        $this->assertDtoHasProperties($dto, ['id']);
    }

    public function testDtoPropertiesAreReadonly(): void
    {
        // Arrange
        $dto = new GetByIdIntInputDto(789);

        // Assert
        $this->assertDtoPropertiesAreReadonly($dto);
    }
}
```

## Running Tests

### Run All DTO Tests

```bash
./vendor/bin/phpunit tests/Unit/Application/Dto/
```

### Run Specific DTO Tests

```bash
./vendor/bin/phpunit tests/Unit/Application/Dto/Input/Shared/
./vendor/bin/phpunit tests/Unit/Application/Dto/Output/Shared/
```

### Run Individual Test

```bash
./vendor/bin/phpunit tests/Unit/Application/Dto/Input/Shared/GetByIdIntInputDtoTest.php
```

## Test Coverage

The DTO tests cover:

- ✅ **Constructor behavior** - Properties are set correctly
- ✅ **Property existence** - All expected properties are present
- ✅ **Readonly properties** - Properties cannot be modified
- ✅ **Immutability** - No setter methods exist
- ✅ **Type safety** - Correct data types are enforced
- ✅ **Final classes** - DTOs are properly sealed
- ✅ **Edge cases** - Empty values, special characters, etc.

## Best Practices

### 1. **Test Data Management**

Use the `getTestData()` method in `BaseDtoTest` for consistent test data:

```php
$testData = $this->getTestData('operator');
$dto = new CreateOperatorInputDto(
    $testData['email'],
    $testData['lastname'],
    // ...
);
```

### 2. **Comprehensive Coverage**

Test both success and edge cases:

- Valid data
- Empty/null values
- Special characters
- Boundary values

### 3. **Clear Test Names**

Use descriptive test names that explain what is being tested:

- `testConstructorSetsAllProperties()`
- `testWithValidData()`
- `testWithEmptyValues()`

### 4. **Consistent Structure**

Follow the Arrange-Act-Assert pattern:

```php
public function testSomething(): void
{
    // Arrange
    $input = 'test value';

    // Act
    $dto = new SomeDto($input);

    // Assert
    $this->assertEquals($input, $dto->property);
}
```

## DTO Testing Guidelines

### When to Test DTOs

- **Always test complex DTOs** with multiple properties
- **Test DTOs with business logic** or validation
- **Test DTOs used in critical paths** (authentication, data transfer)
- **Test DTOs with nullable properties** to ensure proper handling

### When NOT to Test DTOs

- Very simple DTOs with only primitive types
- DTOs that are just data containers without logic
- DTOs that are frequently changing

### Test Priorities

1. **High Priority**: Authentication DTOs, User DTOs, Core business DTOs
2. **Medium Priority**: Configuration DTOs, Report DTOs
3. **Low Priority**: Simple data transfer DTOs

## Troubleshooting

### Common Issues

1. **Type Errors**: Ensure test data matches DTO parameter types
2. **Missing Properties**: Verify all DTO properties are tested
3. **Readonly Violations**: Check that properties are properly readonly
4. **Final Class Issues**: Ensure DTOs are final when expected

### Debugging Tips

```php
// Debug DTO properties
var_dump(get_object_vars($dto));

// Check property types
$reflection = new \ReflectionClass($dto);
$properties = $reflection->getProperties();
foreach ($properties as $property) {
    echo $property->getName() . ': ' . $property->getType() . PHP_EOL;
}
```

## Future Enhancements

1. **Validation Tests**: Add tests for DTO validation logic
2. **Serialization Tests**: Test DTO serialization/deserialization
3. **Factory Tests**: Test DTO factory methods
4. **Performance Tests**: Test DTO creation performance
5. **Contract Tests**: Verify DTO interfaces and contracts

## Conclusion

The DTO testing framework provides comprehensive coverage for data transfer objects, ensuring data integrity, type safety, and immutability. This foundation helps maintain code quality and prevents data-related bugs in the application.
