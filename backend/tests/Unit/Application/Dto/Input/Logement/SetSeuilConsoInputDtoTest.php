<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Dto\Input\Logement;

use App\Application\Dto\Input\Logement\SetSeuilConsoInputDto;
use App\Tests\Unit\Application\Dto\BaseDtoTest;

class SetSeuilConsoInputDtoTest extends BaseDtoTest
{
  public function testConstructorSetsAllProperties(): void
  {
    // Arrange
    $testData = $this->getTestData('seuil_conso');

    // Act
    $dto = new SetSeuilConsoInputDto(
      $testData['seuilConsoEf'],
      $testData['seuilConsoEc'],
      $testData['seuilConsoActif'],
      $testData['seuilConsoEmail']
    );

    // Assert
    $this->assertDtoProperties($dto, $testData);
  }

  public function testDtoHasExpectedProperties(): void
  {
    // Arrange
    $dto = new SetSeuilConsoInputDto(0, 0, 0, 0);

    // Assert
    $this->assertDtoHasProperties($dto, [
      'seuilConsoEf',
      'seuilConsoEc',
      'seuilConsoActif',
      'seuilConsoEmail'
    ]);
  }

  public function testDtoPropertiesAreReadonly(): void
  {
    // Arrange
    $dto = new SetSeuilConsoInputDto(0, 0, 0, 0);

    // Assert
    $this->assertDtoPropertiesAreReadonly($dto);
  }

  public function testDtoIsImmutable(): void
  {
    // Arrange
    $dto = new SetSeuilConsoInputDto(0, 0, 0, 0);

    // Assert
    $this->assertDtoIsImmutable($dto);
  }

  public function testConstructorRequiresAllParameters(): void
  {
    // Assert
    $this->assertDtoConstructorRequiresAllParameters(SetSeuilConsoInputDto::class, [
      'seuilConsoEf',
      'seuilConsoEc',
      'seuilConsoActif',
      'seuilConsoEmail'
    ]);
  }

  public function testWithValidThresholds(): void
  {
    // Arrange
    $seuilConsoEf = 100;
    $seuilConsoEc = 200;
    $seuilConsoActif = 1;
    $seuilConsoEmail = 1;

    // Act
    $dto = new SetSeuilConsoInputDto($seuilConsoEf, $seuilConsoEc, $seuilConsoActif, $seuilConsoEmail);

    // Assert
    $this->assertEquals($seuilConsoEf, $dto->seuilConsoEf);
    $this->assertEquals($seuilConsoEc, $dto->seuilConsoEc);
    $this->assertEquals($seuilConsoActif, $dto->seuilConsoActif);
    $this->assertEquals($seuilConsoEmail, $dto->seuilConsoEmail);
  }

  public function testWithZeroThresholds(): void
  {
    // Arrange & Act
    $dto = new SetSeuilConsoInputDto(0, 0, 0, 0);

    // Assert
    $this->assertEquals(0, $dto->seuilConsoEf);
    $this->assertEquals(0, $dto->seuilConsoEc);
    $this->assertEquals(0, $dto->seuilConsoActif);
    $this->assertEquals(0, $dto->seuilConsoEmail);
  }

  public function testWithHighThresholds(): void
  {
    // Arrange
    $seuilConsoEf = 9999;
    $seuilConsoEc = 8888;
    $seuilConsoActif = 1;
    $seuilConsoEmail = 1;

    // Act
    $dto = new SetSeuilConsoInputDto($seuilConsoEf, $seuilConsoEc, $seuilConsoActif, $seuilConsoEmail);

    // Assert
    $this->assertEquals($seuilConsoEf, $dto->seuilConsoEf);
    $this->assertEquals($seuilConsoEc, $dto->seuilConsoEc);
    $this->assertEquals($seuilConsoActif, $dto->seuilConsoActif);
    $this->assertEquals($seuilConsoEmail, $dto->seuilConsoEmail);
  }

  public function testWithNegativeValues(): void
  {
    // Arrange
    $seuilConsoEf = -100;
    $seuilConsoEc = -200;
    $seuilConsoActif = 0;
    $seuilConsoEmail = 0;

    // Act
    $dto = new SetSeuilConsoInputDto($seuilConsoEf, $seuilConsoEc, $seuilConsoActif, $seuilConsoEmail);

    // Assert
    $this->assertEquals($seuilConsoEf, $dto->seuilConsoEf);
    $this->assertEquals($seuilConsoEc, $dto->seuilConsoEc);
    $this->assertEquals($seuilConsoActif, $dto->seuilConsoActif);
    $this->assertEquals($seuilConsoEmail, $dto->seuilConsoEmail);
  }

  public function testWithSpecialIntegerValues(): void
  {
    // Arrange
    $seuilConsoEf = 100;
    $seuilConsoEc = 200;
    $seuilConsoActif = 1;
    $seuilConsoEmail = 42;

    // Act
    $dto = new SetSeuilConsoInputDto($seuilConsoEf, $seuilConsoEc, $seuilConsoActif, $seuilConsoEmail);

    // Assert
    $this->assertEquals($seuilConsoEmail, $dto->seuilConsoEmail);
  }

  public function testDtoIsFinalClass(): void
  {
    // Assert
    $reflection = new \ReflectionClass(SetSeuilConsoInputDto::class);
    $this->assertTrue($reflection->isFinal(), 'SetSeuilConsoInputDto should be final');
  }
}
