<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Dto\Output\Shared;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Tests\Unit\Application\Dto\BaseDtoTest;

class SuccessOutputDtoTest extends BaseDtoTest
{
  public function testConstructorSetsBoolProperty(): void
  {
    // Arrange
    $success = true;

    // Act
    $dto = new SuccessOutputDto($success);

    // Assert
    $this->assertEquals($success, $dto->bool);
  }

  public function testDtoHasExpectedProperties(): void
  {
    // Arrange
    $dto = new SuccessOutputDto(false);

    // Assert
    $this->assertDtoHasProperties($dto, ['bool']);
  }

  public function testDtoPropertiesAreReadonly(): void
  {
    // Arrange
    $dto = new SuccessOutputDto(true);

    // Assert
    $this->assertDtoPropertiesAreReadonly($dto);
  }

  public function testDtoIsImmutable(): void
  {
    // Arrange
    $dto = new SuccessOutputDto(false);

    // Assert
    $this->assertDtoIsImmutable($dto);
  }

  public function testConstructorRequiresBoolParameter(): void
  {
    // Assert
    $this->assertDtoConstructorRequiresAllParameters(SuccessOutputDto::class, ['bool']);
  }

  public function testWithTrueValue(): void
  {
    // Arrange & Act
    $dto = new SuccessOutputDto(true);

    // Assert
    $this->assertTrue($dto->bool);
    $this->assertIsBool($dto->bool);
  }

  public function testWithFalseValue(): void
  {
    // Arrange & Act
    $dto = new SuccessOutputDto(false);

    // Assert
    $this->assertFalse($dto->bool);
    $this->assertIsBool($dto->bool);
  }

  public function testDtoIsNotFinalClass(): void
  {
    // Assert
    $reflection = new \ReflectionClass(SuccessOutputDto::class);
    $this->assertFalse($reflection->isFinal(), 'SuccessOutputDto should not be final');
  }
}
