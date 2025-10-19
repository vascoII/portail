<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service\DataProvider;

use PHPUnit\Framework\TestCase;
use Mockery;
use Mockery\MockInterface;

abstract class BaseDataProviderTest extends TestCase
{
  protected function tearDown(): void
  {
    Mockery::close();
  }

  /**
   * Create a mock for DataSource interfaces
   */
  protected function createDataSourceMock(string $dataSourceClass): MockInterface
  {
    return Mockery::mock($dataSourceClass);
  }

  /**
   * Create a mock for Transformer interfaces
   */
  protected function createTransformerMock(string $transformerClass): MockInterface
  {
    return Mockery::mock($transformerClass);
  }

  /**
   * Create a mock for AuthService
   */
  protected function createAuthServiceMock(): MockInterface
  {
    return Mockery::mock(\App\Application\Service\Auth\AuthServiceInterface::class);
  }

  /**
   * Create a mock for JWT Service
   */
  protected function createJwtServiceMock(): MockInterface
  {
    return Mockery::mock(\App\Application\Service\Jwt\JwtServiceInterface::class);
  }

  /**
   * Create a mock for Redis Service
   */
  protected function createRedisServiceMock(): MockInterface
  {
    return Mockery::mock(\App\Application\Service\Redis\RedisServiceInterface::class);
  }

  /**
   * Create a mock for Cache Service
   */
  protected function createCacheServiceMock(): MockInterface
  {
    return Mockery::mock('alias:App\Infrastructure\Service\Redis\RedisService');
  }

  /**
   * Create a mock data source result object from an array
   */
  protected function createDataSourceResult(array $data): object
  {
    return (object) $data;
  }

  /**
   * Create a mock DTO with test data
   */
  protected function createDto(string $dtoClass, array $data = []): object
  {
    $dto = new $dtoClass(...array_values($data));
    return $dto;
  }

  /**
   * Assert that a result is of the expected DTO type
   */
  protected function assertResultType(object $result, string $expectedType): void
  {
    $this->assertInstanceOf($expectedType, $result);
  }

  /**
   * Assert that a result has the expected properties
   */
  protected function assertResultHasProperties(object $result, array $expectedProperties): void
  {
    foreach ($expectedProperties as $property => $expectedValue) {
      $this->assertObjectHasProperty($property, $result);
      $this->assertEquals($expectedValue, $result->$property);
    }
  }

  /**
   * Assert that a result has the expected structure
   */
  protected function assertResultStructure(object $result, array $expectedKeys): void
  {
    $actualKeys = array_keys(get_object_vars($result));
    $this->assertEquals($expectedKeys, $actualKeys);
  }

  /**
   * Assert that a result is consistent across multiple calls
   */
  protected function assertResultConsistency(callable $method, array $inputData, int $iterations = 3): void
  {
    $results = [];
    for ($i = 0; $i < $iterations; $i++) {
      $results[] = $method($inputData);
    }

    // All results should be identical
    for ($i = 1; $i < count($results); $i++) {
      $this->assertEquals($results[0], $results[$i]);
    }
  }

  /**
   * Create test authentication context
   */
  protected function createTestAuthContext(): object
  {
    return (object) [
      'pkUser' => 123,
      'sessionId' => 'test_session_123',
      'isAuthenticated' => true
    ];
  }

  /**
   * Create test user DTO
   */
  protected function createTestUserDto(): object
  {
    $userDto = Mockery::mock('alias:App\Application\Dto\Output\Shared\UserDto');
    $userDto->pkUser = 123;
    return $userDto;
  }

  /**
   * Create test session DTO
   */
  protected function createTestSessionDto(): object
  {
    return (object) [
      'session' => (object) [
        'sessionId' => 'test_session_123',
        'userId' => 123,
        'isActive' => true
      ],
      'user' => (object) [
        'id' => 123,
        'email' => 'test@example.com',
        'name' => 'Test User'
      ]
    ];
  }
}
