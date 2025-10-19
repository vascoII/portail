<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\AdminTransformer;
use App\Application\Factory\Admin\AdminEntityFactory;
use App\Application\Factory\Admin\AdminOutputFactory;
use App\Application\Dto\Output\Admin\LoginFromParamOutputDto;
use App\Application\Dto\Output\Admin\GetSousTraitantsOutputDto;
use App\Application\Dto\Output\Admin\UpdateEmailFromPKUserOutputDto;
use App\Application\Dto\Output\Admin\UpdateCGUFromPKUserOutputDto;
use App\Application\Dto\Output\Admin\ResetPasswordFromEmailOutputDto;
use App\Application\Dto\Output\Shared\UserDto;

class AdminTransformerTest extends BaseTransformerTest
{
  private AdminTransformer $transformer;
  private AdminEntityFactory $entityFactory;
  private AdminOutputFactory $outputFactory;

  protected function setUp(): void
  {
    $this->entityFactory = new AdminEntityFactory();
    $this->outputFactory = new AdminOutputFactory();
    $this->transformer = new AdminTransformer($this->entityFactory, $this->outputFactory);
  }

  public function testTransformLoginFromParam(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'LoginFromParamResult' => 'test_session_id'
    ]);

    // Act
    $result = $this->transformer->transformLoginFromParam($dataSourceResult);

    // Assert
    $this->assertInstanceOf(LoginFromParamOutputDto::class, $result);
    $this->assertEquals('test_session_id', $result->session);
  }

  public function testTransformGetSousTraitantsWithArray(): void
  {
    // Arrange
    $sousTraitants = [
      (object) ['id' => 1, 'name' => 'Sous-traitant 1'],
      (object) ['id' => 2, 'name' => 'Sous-traitant 2']
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'GetSousTraitantsResult' => $sousTraitants
    ]);

    // Act
    $result = $this->transformer->transformGetSousTraitants($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetSousTraitantsOutputDto::class, $result);
    $this->assertEquals($sousTraitants, $result->sousTraitants);
  }

  public function testTransformGetSousTraitantsWithSingleObject(): void
  {
    // Arrange
    $sousTraitant = (object) ['id' => 1, 'name' => 'Sous-traitant 1'];
    $dataSourceResult = $this->createDataSourceResult([
      'GetSousTraitantsResult' => $sousTraitant
    ]);

    // Act
    $result = $this->transformer->transformGetSousTraitants($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetSousTraitantsOutputDto::class, $result);
    $this->assertEquals([$sousTraitant], $result->sousTraitants);
  }

  public function testTransformGetSousTraitantsWithNull(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'GetSousTraitantsResult' => null
    ]);

    // Act
    $result = $this->transformer->transformGetSousTraitants($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetSousTraitantsOutputDto::class, $result);
    $this->assertEquals([], $result->sousTraitants);
  }

  public function testTransformUpdateEmailFromPKUser(): void
  {
    // Arrange
    $soapUser = $this->createSoapUser(['PKUser' => 123]);
    $dataSourceResult = $this->createDataSourceResult([
      'UpdateEmailFromPKUserResult' => $soapUser
    ]);

    // Act
    $result = $this->transformer->transformUpdateEmailFromPKUser($dataSourceResult);

    // Assert
    $this->assertInstanceOf(UpdateEmailFromPKUserOutputDto::class, $result);
    $this->assertInstanceOf(UserDto::class, $result->user);
  }

  public function testTransformUpdateCGUFromPKUser(): void
  {
    // Arrange
    $soapUser = $this->createSoapUser(['PKUser' => 123]);
    $dataSourceResult = $this->createDataSourceResult([
      'UpdateCGUFromPKUserResult' => $soapUser
    ]);

    // Act
    $result = $this->transformer->transformUpdateCGUFromPKUser($dataSourceResult);

    // Assert
    $this->assertInstanceOf(UpdateCGUFromPKUserOutputDto::class, $result);
    $this->assertInstanceOf(UserDto::class, $result->user);
  }

  public function testTransformResetPasswordFromEmail(): void
  {
    // Arrange
    $soapUser = $this->createSoapUser(['PKUser' => 123]);
    $dataSourceResult = $this->createDataSourceResult([
      'ResetPasswordFromEmailResult' => $soapUser
    ]);

    // Act
    $result = $this->transformer->transformResetPasswordFromEmail($dataSourceResult);

    // Assert
    $this->assertInstanceOf(ResetPasswordFromEmailOutputDto::class, $result);
    $this->assertInstanceOf(UserDto::class, $result->user);
  }

  public function testTransformUser(): void
  {
    // Arrange
    $soapUser = $this->createSoapUser([
      'LoginID' => 'test_login',
      'UserName' => 'test_user',
      'EMail' => 'test@example.com',
      'UserType' => 'admin',
      'PKUser' => 123,
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
    ]);

    // Act
    $result = $this->transformer->transformUpdateEmailFromPKUser(
      $this->createDataSourceResult(['UpdateEmailFromPKUserResult' => $soapUser])
    );

    // Assert
    $this->assertInstanceOf(UpdateEmailFromPKUserOutputDto::class, $result);
    $user = $result->user;
    $this->assertEquals('test_login', $user->loginId);
    $this->assertEquals('test_user', $user->userName);
    $this->assertEquals('test@example.com', $user->email);
    $this->assertEquals('admin', $user->userType);
    $this->assertEquals(123, $user->pkUser);
    $this->assertEquals('123 Test Street', $user->adresse);
    $this->assertEquals('75001', $user->cp);
    $this->assertEquals('Paris', $user->ville);
    $this->assertEquals(1, $user->fk);
    $this->assertEquals('0123456789', $user->phoneNumber);
    $this->assertEquals('Test', $user->firstName);
    $this->assertEquals('admin', $user->userRole);
    $this->assertEquals('Test Client', $user->clientName);
    $this->assertEquals('client_123', $user->clientId);
    $this->assertEquals('accepted', $user->cgu);
    $this->assertEquals(1, $user->fkClient);
    $this->assertEquals(1, $user->fkClientTop);
    $this->assertEquals(5, $user->nbImmeubles);
    $this->assertEquals(100, $user->seuilConsoEf);
    $this->assertEquals(200, $user->seuilConsoEc);
    $this->assertEquals(300, $user->seuilConsoRepart);
    $this->assertEquals(400, $user->seuilConsoCet);
    $this->assertTrue($user->seuilConsoActif);
    $this->assertEquals('test@example.com', $user->seuilConsoEmail);
    $this->assertTrue($user->showImmeublesArc);
    $this->assertTrue($user->showFactures);
    $this->assertTrue($user->showChgtOccupant);
    $this->assertTrue($user->showChantiers);
  }

  public function testTransformUserWithNullValues(): void
  {
    // Arrange
    $soapUser = $this->createSoapUser([
      'LoginID' => null,
      'UserName' => null,
      'EMail' => null,
      'UserType' => null,
      'PKUser' => 0,
      'Adresse' => null,
      'CP' => null,
      'Ville' => null,
      'FK' => 0,
      'PhoneNumber' => null,
      'FirstName' => null,
      'UserRole' => null,
      'ClientName' => null,
      'ClientID' => null,
      'CGU' => null,
      'FKClient' => 0,
      'FKClientTop' => 0,
      'NbImmeubles' => 0,
      'Seuil_Conso_EF' => 0,
      'Seuil_Conso_EC' => 0,
      'Seuil_Conso_Repart' => 0,
      'Seuil_Conso_CET' => 0,
      'Seuil_Conso_Actif' => false,
      'Seuil_Conso_Email' => null,
      'showImmeublesArc' => false,
      'showFactures' => false,
      'showChgtOccupant' => false,
      'showChantiers' => false
    ]);

    // Act
    $result = $this->transformer->transformUpdateEmailFromPKUser(
      $this->createDataSourceResult(['UpdateEmailFromPKUserResult' => $soapUser])
    );

    // Assert
    $this->assertInstanceOf(UpdateEmailFromPKUserOutputDto::class, $result);
    $user = $result->user;
    $this->assertEquals('', $user->loginId);
    $this->assertEquals('', $user->userName);
    $this->assertEquals('', $user->email);
    $this->assertEquals('', $user->userType);
    $this->assertEquals(0, $user->pkUser);
    $this->assertEquals('', $user->adresse);
    $this->assertEquals('', $user->cp);
    $this->assertEquals('', $user->ville);
    $this->assertEquals(0, $user->fk);
    $this->assertEquals('', $user->phoneNumber);
    $this->assertEquals('', $user->firstName);
    $this->assertEquals('', $user->userRole);
    $this->assertEquals('', $user->clientName);
    $this->assertEquals('', $user->clientId);
    $this->assertEquals('', $user->cgu);
    $this->assertEquals(0, $user->fkClient);
    $this->assertEquals(0, $user->fkClientTop);
    $this->assertEquals(0, $user->nbImmeubles);
    $this->assertEquals(0, $user->seuilConsoEf);
    $this->assertEquals(0, $user->seuilConsoEc);
    $this->assertEquals(0, $user->seuilConsoRepart);
    $this->assertEquals(0, $user->seuilConsoCet);
    $this->assertFalse($user->seuilConsoActif);
    $this->assertEquals('', $user->seuilConsoEmail);
    $this->assertFalse($user->showImmeublesArc);
    $this->assertFalse($user->showFactures);
    $this->assertFalse($user->showChgtOccupant);
    $this->assertFalse($user->showChantiers);
  }
}
