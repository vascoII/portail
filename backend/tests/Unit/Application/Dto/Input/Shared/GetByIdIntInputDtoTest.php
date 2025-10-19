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

  public function testDtoIsImmutable(): void
  {
    // Arrange
    $dto = new GetByIdIntInputDto(999);

    // Assert
    $this->assertDtoIsImmutable($dto);
  }

  public function testConstructorRequiresIdParameter(): void
  {
    // Assert
    $this->assertDtoConstructorRequiresAllParameters(GetByIdIntInputDto::class, ['id']);
  }

  public function testWithDifferentIdValues(): void
  {
    // Test with positive integer
    $dto1 = new GetByIdIntInputDto(1);
    $this->assertEquals(1, $dto1->id);

    // Test with zero
    $dto2 = new GetByIdIntInputDto(0);
    $this->assertEquals(0, $dto2->id);

    // Test with large integer
    $dto3 = new GetByIdIntInputDto(999999);
    $this->assertEquals(999999, $dto3->id);
  }

  public function testDtoIsFinalClass(): void
  {
    // Assert
    $reflection = new \ReflectionClass(GetByIdIntInputDto::class);
    $this->assertTrue($reflection->isFinal(), 'GetByIdIntInputDto should be final');
  }
}
