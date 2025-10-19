<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\UseCase;

use PHPUnit\Framework\TestCase;
use Mockery;

/**
 * Base test class for UseCase testing
 * Provides common setup and utilities for UseCase tests
 */
abstract class BaseUseCaseTest extends TestCase
{
  protected function tearDown(): void
  {
    Mockery::close();
    parent::tearDown();
  }

  /**
   * Create a mock for any DataProvider interface
   */
  protected function createDataProviderMock(string $interfaceClass): object
  {
    return Mockery::mock($interfaceClass);
  }

  /**
   * Assert that a method was called once with specific parameters
   */
  protected function assertMethodCalledOnce(object $mock, string $method, $parameters = null): void
  {
    if ($parameters !== null) {
      $mock->shouldHaveReceived($method)->with($parameters)->once();
    } else {
      $mock->shouldHaveReceived($method)->once();
    }
  }

  /**
   * Create a mock for final classes using partial mocking
   */
  protected function createFinalClassMock(string $className): object
  {
    return Mockery::mock($className)->makePartial();
  }

  /**
   * Assert that a method was called with any parameters
   */
  protected function assertMethodCalledWithAny(object $mock, string $method): void
  {
    $mock->shouldHaveReceived($method)->with(Mockery::any())->once();
  }
}
