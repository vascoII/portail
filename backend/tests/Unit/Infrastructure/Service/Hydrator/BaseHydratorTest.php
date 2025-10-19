<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Hydrator;

use PHPUnit\Framework\TestCase;
use Mockery;
use Mockery\MockInterface;

abstract class BaseHydratorTest extends TestCase
{
  protected function tearDown(): void
  {
    Mockery::close();
  }

  /**
   * Create a mock for DTO classes
   */
  protected function createDtoMock(string $dtoClass): object
  {
    return $this->createMock($dtoClass);
  }

  /**
   * Create a mock data source result object
   */
  protected function createDataSourceResult(array $data = []): object
  {
    $result = new \stdClass();
    foreach ($data as $key => $value) {
      $result->$key = $value;
    }
    return $result;
  }

  /**
   * Create a mock input DTO with test data
   */
  protected function createInputDto(string $dtoClass, array $data = []): object
  {
    $dto = new $dtoClass(...array_values($data));
    return $dto;
  }

  /**
   * Assert that a hydrated object has the expected properties
   */
  protected function assertHydratedObjectHasProperties(object $hydrated, array $expectedProperties): void
  {
    foreach ($expectedProperties as $property => $expectedValue) {
      $this->assertObjectHasProperty($property, $hydrated);
      $this->assertEquals($expectedValue, $hydrated->$property);
    }
  }

  /**
   * Assert that a hydrated object has the expected structure
   */
  protected function assertHydratedObjectStructure(object $hydrated, array $expectedKeys): void
  {
    $actualKeys = array_keys(get_object_vars($hydrated));
    $this->assertEquals($expectedKeys, $actualKeys);
  }

  /**
   * Assert that a hydrated object is of the correct type
   */
  protected function assertHydratedObjectType(object $hydrated): void
  {
    $this->assertIsObject($hydrated);
    $this->assertInstanceOf(\stdClass::class, $hydrated);
  }

  /**
   * Assert that a hydrated object has the expected count of properties
   */
  protected function assertHydratedObjectPropertyCount(object $hydrated, int $expectedCount): void
  {
    $actualCount = count(get_object_vars($hydrated));
    $this->assertEquals($expectedCount, $actualCount);
  }

  /**
   * Assert that a hydrated object contains specific values
   */
  protected function assertHydratedObjectContainsValues(object $hydrated, array $expectedValues): void
  {
    $actualValues = array_values(get_object_vars($hydrated));
    foreach ($expectedValues as $expectedValue) {
      $this->assertContains($expectedValue, $actualValues);
    }
  }

  /**
   * Assert that a hydrated object does not contain specific values
   */
  protected function assertHydratedObjectDoesNotContainValues(object $hydrated, array $unexpectedValues): void
  {
    $actualValues = array_values(get_object_vars($hydrated));
    foreach ($unexpectedValues as $unexpectedValue) {
      $this->assertNotContains($unexpectedValue, $actualValues);
    }
  }

  /**
   * Assert that a hydrated object has properties with correct types
   */
  protected function assertHydratedObjectPropertyTypes(object $hydrated, array $expectedTypes): void
  {
    foreach ($expectedTypes as $property => $expectedType) {
      $this->assertObjectHasProperty($property, $hydrated);
      $this->assertType($expectedType, $hydrated->$property);
    }
  }

  /**
   * Assert that a value is of a specific type (compatible with all PHPUnit versions)
   */
  protected function assertType(string $expectedType, $actual, string $message = ''): void
  {
    $actualType = gettype($actual);

    // Map PHP types to expected types
    $typeMap = [
      'integer' => 'int',
      'double' => 'float',
      'boolean' => 'bool',
      'string' => 'string',
      'array' => 'array',
      'object' => 'object',
      'resource' => 'resource',
      'NULL' => 'null'
    ];

    $normalizedActualType = $typeMap[$actualType] ?? $actualType;

    if ($expectedType === 'object') {
      $this->assertIsObject($actual, $message);
    } elseif ($expectedType === 'array') {
      $this->assertIsArray($actual, $message);
    } elseif ($expectedType === 'string') {
      $this->assertIsString($actual, $message);
    } elseif ($expectedType === 'int') {
      $this->assertIsInt($actual, $message);
    } elseif ($expectedType === 'float') {
      $this->assertIsFloat($actual, $message);
    } elseif ($expectedType === 'bool') {
      $this->assertIsBool($actual, $message);
    } else {
      $this->assertEquals($expectedType, $normalizedActualType, $message);
    }
  }

  /**
   * Assert that a hydrated object is consistent across multiple calls
   */
  protected function assertHydratedObjectConsistency(callable $hydrateMethod, array $inputData, int $iterations = 3): void
  {
    $results = [];
    for ($i = 0; $i < $iterations; $i++) {
      $results[] = $hydrateMethod($inputData);
    }

    // All results should be identical
    for ($i = 1; $i < count($results); $i++) {
      $this->assertEquals($results[0], $results[$i]);
    }
  }
}
