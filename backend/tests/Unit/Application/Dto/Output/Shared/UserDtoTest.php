<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Dto\Output\Shared;

use App\Application\Dto\Output\Shared\UserDto;
use App\Tests\Unit\Application\Dto\BaseDtoTest;

class UserDtoTest extends BaseDtoTest
{
  public function testConstructorSetsAllProperties(): void
  {
    // Arrange
    $testData = $this->getTestData('user');

    // Act
    $dto = new UserDto(
      $testData['loginId'],
      $testData['userName'],
      $testData['email'],
      $testData['userType'],
      $testData['pkUser'],
      $testData['adresse'],
      $testData['cp'],
      $testData['ville'],
      $testData['fk'],
      $testData['phoneNumber'],
      $testData['firstName'],
      $testData['userRole'],
      $testData['clientName'],
      $testData['clientId'],
      $testData['cgu'],
      $testData['fkClient'],
      $testData['fkClientTop'],
      $testData['nbImmeubles'],
      $testData['seuilConsoEf'],
      $testData['seuilConsoEc'],
      $testData['seuilConsoRepart'],
      $testData['seuilConsoCet'],
      $testData['seuilConsoActif'],
      $testData['seuilConsoEmail'],
      $testData['showImmeublesArc'],
      $testData['showFactures'],
      $testData['showChgtOccupant'],
      $testData['showChantiers']
    );

    // Assert
    $this->assertDtoProperties($dto, $testData);
  }

  public function testDtoHasExpectedProperties(): void
  {
    // Arrange
    $dto = $this->createMinimalUserDto();

    // Assert
    $this->assertDtoHasProperties($dto, [
      'loginId',
      'userName',
      'email',
      'userType',
      'pkUser',
      'adresse',
      'cp',
      'ville',
      'fk',
      'phoneNumber',
      'firstName',
      'userRole',
      'clientName',
      'clientId',
      'cgu',
      'fkClient',
      'fkClientTop',
      'nbImmeubles',
      'seuilConsoEf',
      'seuilConsoEc',
      'seuilConsoRepart',
      'seuilConsoCet',
      'seuilConsoActif',
      'seuilConsoEmail',
      'showImmeublesArc',
      'showFactures',
      'showChgtOccupant',
      'showChantiers'
    ]);
  }

  public function testDtoPropertiesAreReadonly(): void
  {
    // Arrange
    $dto = $this->createMinimalUserDto();

    // Assert
    $this->assertDtoPropertiesAreReadonly($dto);
  }

  public function testDtoIsImmutable(): void
  {
    // Arrange
    $dto = $this->createMinimalUserDto();

    // Assert
    $this->assertDtoIsImmutable($dto);
  }

  public function testConstructorRequiresAllParameters(): void
  {
    // Assert
    $this->assertDtoConstructorRequiresAllParameters(UserDto::class, [
      'loginId',
      'userName',
      'email',
      'userType',
      'pkUser',
      'adresse',
      'cp',
      'ville',
      'fk',
      'phoneNumber',
      'firstName',
      'userRole',
      'clientName',
      'clientId',
      'cgu',
      'fkClient',
      'fkClientTop',
      'nbImmeubles',
      'seuilConsoEf',
      'seuilConsoEc',
      'seuilConsoRepart',
      'seuilConsoCet',
      'seuilConsoActif',
      'seuilConsoEmail',
      'showImmeublesArc',
      'showFactures',
      'showChgtOccupant',
      'showChantiers'
    ]);
  }

  public function testWithNullValues(): void
  {
    // Arrange & Act
    $dto = new UserDto(
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null
    );

    // Assert
    $this->assertNull($dto->loginId);
    $this->assertNull($dto->userName);
    $this->assertNull($dto->email);
    $this->assertNull($dto->userType);
    $this->assertNull($dto->pkUser);
  }

  public function testWithMixedNullAndValidValues(): void
  {
    // Arrange & Act
    $dto = new UserDto(
      'johndoe',           // loginId
      null,                // userName
      'john@example.com',  // email
      'operator',          // userType
      123,                 // pkUser
      null,                // adresse
      '12345',             // cp
      'Test City',         // ville
      null,                // fk
      '1234567890',        // phoneNumber
      'John',              // firstName
      'admin',             // userRole
      null,                // clientName
      'client123',         // clientId
      '1',                 // cgu
      1,                   // fkClient
      null,                // fkClientTop
      5,                   // nbImmeubles
      100,                 // seuilConsoEf
      null,                // seuilConsoEc
      300,                 // seuilConsoRepart
      null,                // seuilConsoCet
      true,                // seuilConsoActif
      'test@example.com',  // seuilConsoEmail
      false,               // showImmeublesArc
      true,                // showFactures
      null,                // showChgtOccupant
      false                // showChantiers
    );

    // Assert
    $this->assertEquals('johndoe', $dto->loginId);
    $this->assertNull($dto->userName);
    $this->assertEquals('john@example.com', $dto->email);
    $this->assertEquals('operator', $dto->userType);
    $this->assertEquals(123, $dto->pkUser);
    $this->assertNull($dto->adresse);
    $this->assertEquals('12345', $dto->cp);
    $this->assertEquals('Test City', $dto->ville);
    $this->assertNull($dto->fk);
    $this->assertEquals('1234567890', $dto->phoneNumber);
    $this->assertEquals('John', $dto->firstName);
    $this->assertEquals('admin', $dto->userRole);
    $this->assertNull($dto->clientName);
    $this->assertEquals('client123', $dto->clientId);
    $this->assertEquals('1', $dto->cgu);
    $this->assertEquals(1, $dto->fkClient);
    $this->assertNull($dto->fkClientTop);
    $this->assertEquals(5, $dto->nbImmeubles);
    $this->assertEquals(100, $dto->seuilConsoEf);
    $this->assertNull($dto->seuilConsoEc);
    $this->assertEquals(300, $dto->seuilConsoRepart);
    $this->assertNull($dto->seuilConsoCet);
    $this->assertTrue($dto->seuilConsoActif);
    $this->assertEquals('test@example.com', $dto->seuilConsoEmail);
    $this->assertFalse($dto->showImmeublesArc);
    $this->assertTrue($dto->showFactures);
    $this->assertNull($dto->showChgtOccupant);
    $this->assertFalse($dto->showChantiers);
  }

  public function testDtoIsFinalClass(): void
  {
    // Assert
    $reflection = new \ReflectionClass(UserDto::class);
    $this->assertTrue($reflection->isFinal(), 'UserDto should be final');
  }

  private function createMinimalUserDto(): UserDto
  {
    return new UserDto(
      'test',
      'Test User',
      'test@example.com',
      'user',
      1,
      'Test Address',
      '12345',
      'Test City',
      1,
      '1234567890',
      'Test',
      'user',
      'Test Client',
      'client1',
      '1',
      1,
      1,
      1,
      100,
      200,
      300,
      400,
      true,
      'test@example.com',
      true,
      true,
      true,
      true
    );
  }
}
