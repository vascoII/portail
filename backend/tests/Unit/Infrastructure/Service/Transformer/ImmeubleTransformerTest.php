<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\ImmeubleTransformer;
use App\Application\Factory\Immeuble\ImmeubleEntityFactory;
use App\Application\Factory\Immeuble\ImmeubleOutputFactory;
use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Domain\Entity\Immeuble;

class ImmeubleTransformerTest extends BaseTransformerTest
{
  private ImmeubleTransformer $transformer;
  private ImmeubleEntityFactory|MockInterface $entityFactory;
  private ImmeubleOutputFactory|MockInterface $outputFactory;

  protected function setUp(): void
  {
    $this->entityFactory = $this->createFactoryMock(ImmeubleEntityFactory::class);
    $this->outputFactory = $this->createFactoryMock(ImmeubleOutputFactory::class);
    $this->transformer = new ImmeubleTransformer($this->entityFactory, $this->outputFactory);
  }

  public function testTransformListImmeublesWithArray(): void
  {
    // Arrange
    $immeublesRaw = [
      (object) ['id' => 1, 'name' => 'Immeuble 1'],
      (object) ['id' => 2, 'name' => 'Immeuble 2']
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeInfosImmeubles' => (object) ['infosImmeuble' => $immeublesRaw]
    ]);

    $entities = [
      $this->createEntityMock(Immeuble::class),
      $this->createEntityMock(Immeuble::class)
    ];
    $expectedOutput = $this->createDtoMock(ListImmeublesOutputDto::class);

    $this->entityFactory
      ->expects($this->once())
      ->method('createManyImmeublesFromRawList')
      ->with($immeublesRaw)
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())
      ->method('createListImmeubles')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListImmeubles($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListImmeublesWithSingleObject(): void
  {
    // Arrange
    $immeubleRaw = (object) ['id' => 1, 'name' => 'Immeuble 1'];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeInfosImmeubles' => (object) ['infosImmeuble' => $immeubleRaw]
    ]);

    $entities = [$this->createEntityMock(Immeuble::class)];
    $expectedOutput = $this->createDtoMock(ListImmeublesOutputDto::class);

    $this->entityFactory
      ->expects($this->once())
      ->method('createManyImmeublesFromRawList')
      ->with([$immeubleRaw])
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())
      ->method('createListImmeubles')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListImmeubles($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListImmeublesWithNull(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ListeInfosImmeubles' => (object) ['infosImmeuble' => null]
    ]);

    $expectedOutput = $this->createDtoMock(ListImmeublesOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyImmeublesFromRawList')
      ->with([])
      ->willReturn([]);

    $this->outputFactory
      ->expects($this->once())->method('createListImmeubles')
      ->with([])
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListImmeubles($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListImmeublesWithMissingProperty(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ListeInfosImmeubles' => (object) []
    ]);

    $expectedOutput = $this->createDtoMock(ListImmeublesOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyImmeublesFromRawList')
      ->with([])
      ->willReturn([]);

    $this->outputFactory
      ->expects($this->once())->method('createListImmeubles')
      ->with([])
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListImmeubles($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformGetImmeuble(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'id' => 1,
      'name' => 'Test Immeuble'
    ]);

    $entity = $this->createEntityMock(Immeuble::class);
    $expectedOutput = $this->createDtoMock(GetImmeubleOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createImmeubleFromRaw')
      ->with($dataSourceResult)
      ->willReturn($entity);

    $this->outputFactory
      ->expects($this->once())->method('createGetImmeuble')
      ->with($entity)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformGetImmeuble($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformGetImmeubleWithComplexData(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'id' => 123,
      'name' => 'Complex Immeuble',
      'address' => '123 Test Street',
      'city' => 'Paris',
      'postalCode' => '75001',
      'active' => true,
      'createdAt' => '2023-01-01 00:00:00',
      'updatedAt' => '2023-12-31 23:59:59'
    ]);

    $entity = $this->createEntityMock(Immeuble::class);
    $expectedOutput = $this->createDtoMock(GetImmeubleOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createImmeubleFromRaw')
      ->with($dataSourceResult)
      ->willReturn($entity);

    $this->outputFactory
      ->expects($this->once())->method('createGetImmeuble')
      ->with($entity)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformGetImmeuble($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }
}
