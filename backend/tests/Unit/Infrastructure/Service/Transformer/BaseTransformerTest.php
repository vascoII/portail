<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use PHPUnit\Framework\TestCase;
use Mockery;
use Mockery\MockInterface;

abstract class BaseTransformerTest extends TestCase
{
  protected function tearDown(): void
  {
    Mockery::close();
  }

  /**
   * Create a mock for factory classes
   */
  protected function createFactoryMock(string $factoryClass): object
  {
    return $this->createPartialMock($factoryClass, []);
  }

  /**
   * Create a mock for entity classes
   */
  protected function createEntityMock(string $entityClass): object
  {
    return $this->createPartialMock($entityClass, []);
  }

  /**
   * Create a mock for DTO classes
   */
  protected function createDtoMock(string $dtoClass): object
  {
    return $this->createPartialMock($dtoClass, []);
  }

  /**
   * Create a mock for final classes using partial mocking
   */
  protected function createFinalClassMock(string $className): object
  {
    return Mockery::mock($className)->makePartial();
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
   * Create a mock SOAP user object
   */
  protected function createSoapUser(array $data = []): object
  {
    $defaultData = [
      'LoginID' => 'test_login',
      'UserName' => 'test_user',
      'EMail' => 'test@example.com',
      'UserType' => 'admin',
      'PKUser' => 1,
      'Adresse' => '123 Test Street',
      'CP' => '75001',
      'Ville' => 'Paris',
      'FK' => 1,
      'PhoneNumber' => '0123456789',
      'FirstName' => 'Test',
      'UserRole' => 'admin',
      'ClientName' => 'Test Client',
      'ClientID' => 'client_123',
      'CGU' => 'accepted',
      'FKClient' => 1,
      'FKClientTop' => 1,
      'NbImmeubles' => 5,
      'Seuil_Conso_EF' => 100,
      'Seuil_Conso_EC' => 200,
      'Seuil_Conso_Repart' => 300,
      'Seuil_Conso_CET' => 400,
      'Seuil_Conso_Actif' => true,
      'Seuil_Conso_Email' => 'test@example.com',
      'showImmeublesArc' => true,
      'showFactures' => true,
      'showChgtOccupant' => true,
      'showChantiers' => true
    ];

    $user = new \stdClass();
    foreach (array_merge($defaultData, $data) as $key => $value) {
      $user->$key = $value;
    }
    return $user;
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
   * Assert that a method was called with any parameters
   */
  protected function assertMethodCalledWithAny(object $mock, string $method): void
  {
    $mock->shouldHaveReceived($method)->once();
  }

  /**
   * Assert that a method was called a specific number of times
   */
  protected function assertMethodCalledTimes(object $mock, string $method, int $times): void
  {
    $mock->shouldHaveReceived($method)->times($times);
  }

  /**
   * Assert that a method was never called
   */
  protected function assertMethodNeverCalled(object $mock, string $method): void
  {
    $mock->shouldNotHaveReceived($method);
  }
}
