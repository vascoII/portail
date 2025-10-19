<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Dto;

use PHPUnit\Framework\TestCase;

/**
 * Base test class for DTO testing
 * Provides common utilities and assertions for DTO tests
 */
abstract class BaseDtoTest extends TestCase
{
  /**
   * Assert that a DTO has the expected properties with correct values
   */
  protected function assertDtoProperties(object $dto, array $expectedProperties): void
  {
    foreach ($expectedProperties as $property => $expectedValue) {
      $this->assertTrue(property_exists($dto, $property), "Property '{$property}' does not exist on DTO");
      $this->assertEquals($expectedValue, $dto->$property, "Property '{$property}' has unexpected value");
    }
  }

  /**
   * Assert that a DTO has the expected properties (without checking values)
   */
  protected function assertDtoHasProperties(object $dto, array $expectedProperties): void
  {
    foreach ($expectedProperties as $property) {
      $this->assertTrue(property_exists($dto, $property), "Property '{$property}' does not exist on DTO");
    }
  }

  /**
   * Assert that all DTO properties are readonly
   */
  protected function assertDtoPropertiesAreReadonly(object $dto): void
  {
    $reflection = new \ReflectionClass($dto);
    $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

    foreach ($properties as $property) {
      $this->assertTrue($property->isReadOnly(), "Property '{$property->getName()}' is not readonly");
    }
  }

  /**
   * Assert that a DTO is immutable (no setters)
   */
  protected function assertDtoIsImmutable(object $dto): void
  {
    $reflection = new \ReflectionClass($dto);
    $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);

    foreach ($methods as $method) {
      $methodName = $method->getName();
      if (str_starts_with($methodName, 'set')) {
        $this->fail("DTO should be immutable, but found setter method: {$methodName}");
      }
    }
  }

  /**
   * Assert that a DTO constructor requires all parameters
   */
  protected function assertDtoConstructorRequiresAllParameters(string $dtoClass, array $expectedParameters): void
  {
    $reflection = new \ReflectionClass($dtoClass);
    $constructor = $reflection->getConstructor();

    $this->assertNotNull($constructor, "DTO should have a constructor");

    $parameters = $constructor->getParameters();
    $this->assertCount(count($expectedParameters), $parameters, "Constructor should have " . count($expectedParameters) . " parameters");

    foreach ($parameters as $index => $parameter) {
      $this->assertTrue($parameter->isPromoted(), "Parameter '{$parameter->getName()}' should be promoted");
      // Note: isReadOnly() method is available in PHP 8.1+
      if (method_exists($parameter, 'isReadOnly')) {
        $this->assertTrue($parameter->isReadOnly(), "Parameter '{$parameter->getName()}' should be readonly");
      }
    }
  }

  /**
   * Create test data for DTOs
   */
  protected function getTestData(string $type): array
  {
    return match ($type) {
      'operator' => [
        'email' => 'test@example.com',
        'lastname' => 'Doe',
        'firstname' => 'John',
        'phone' => '1234567890',
        'job' => 'Developer'
      ],
      'user' => [
        'loginId' => 'johndoe',
        'userName' => 'John Doe',
        'email' => 'john@example.com',
        'userType' => 'operator',
        'pkUser' => 123,
        'adresse' => '123 Main St',
        'cp' => '12345',
        'ville' => 'Test City',
        'fk' => 1,
        'phoneNumber' => '1234567890',
        'firstName' => 'John',
        'userRole' => 'admin',
        'clientName' => 'Test Client',
        'clientId' => 'client123',
        'cgu' => '1',
        'fkClient' => 1,
        'fkClientTop' => 1,
        'nbImmeubles' => 5,
        'seuilConsoEf' => 100,
        'seuilConsoEc' => 200,
        'seuilConsoRepart' => 300,
        'seuilConsoCet' => 400,
        'seuilConsoActif' => true,
        'seuilConsoEmail' => 'test@example.com',
        'showImmeublesArc' => true,
        'showFactures' => true,
        'showChgtOccupant' => true,
        'showChantiers' => true
      ],
      'login' => [
        'username' => 'test@example.com',
        'password' => 'password123'
      ],
      'report' => [
        'type' => 'anomalies',
        'params' => '{"dateFrom":"2024-01-01","dateTo":"2024-12-31"}'
      ],
      'seuil_conso' => [
        'seuilConsoEf' => 100,
        'seuilConsoEc' => 200,
        'seuilConsoActif' => 1,
        'seuilConsoEmail' => 1
      ],
      default => []
    };
  }
}
