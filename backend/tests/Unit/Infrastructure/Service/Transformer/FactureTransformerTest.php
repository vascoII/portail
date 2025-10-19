<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\FactureTransformer;
use App\Application\Factory\Facture\FactureEntityFactory;
use App\Application\Factory\Facture\FactureOutputFactory;
use App\Application\Dto\Output\Facture\ListFacturesOutputDto;
use App\Domain\Entity\Facture;

class FactureTransformerTest extends BaseTransformerTest
{
  private FactureTransformer $transformer;
  private FactureEntityFactory|MockInterface $entityFactory;
  private FactureOutputFactory|MockInterface $outputFactory;

  protected function setUp(): void
  {
    $this->entityFactory = $this->createFactoryMock(FactureEntityFactory::class);
    $this->outputFactory = $this->createFactoryMock(FactureOutputFactory::class);
    $this->transformer = new FactureTransformer($this->entityFactory, $this->outputFactory);
  }

  public function testTransformListFacturesWithArray(): void
  {
    // Arrange
    $facturesRaw = [
      (object) ['id' => 1, 'amount' => 100.50],
      (object) ['id' => 2, 'amount' => 200.75]
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeFactures' => (object) ['facture' => $facturesRaw]
    ]);

    $entities = [
      $this->createEntityMock(Facture::class),
      $this->createEntityMock(Facture::class)
    ];
    $expectedOutput = $this->createDtoMock(ListFacturesOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyFromRawList')
      ->with($facturesRaw)
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())->method('create')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListFactures($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListFacturesWithSingleObject(): void
  {
    // Arrange
    $factureRaw = (object) ['id' => 1, 'amount' => 100.50];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeFactures' => (object) ['facture' => $factureRaw]
    ]);

    $entities = [$this->createEntityMock(Facture::class)];
    $expectedOutput = $this->createDtoMock(ListFacturesOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyFromRawList')
      ->with([$factureRaw])
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())->method('create')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListFactures($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListFacturesWithNull(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ListeFactures' => (object) ['facture' => null]
    ]);

    $expectedOutput = $this->createDtoMock(ListFacturesOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyFromRawList')
      ->with([])
      ->willReturn([]);

    $this->outputFactory
      ->expects($this->once())->method('create')
      ->with([])
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListFactures($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListFacturesWithMissingProperty(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ListeFactures' => (object) []
    ]);

    $expectedOutput = $this->createDtoMock(ListFacturesOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyFromRawList')
      ->with([])
      ->willReturn([]);

    $this->outputFactory
      ->expects($this->once())->method('create')
      ->with([])
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListFactures($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListFacturesWithComplexData(): void
  {
    // Arrange
    $facturesRaw = [
      (object) [
        'id' => 1,
        'amount' => 100.50,
        'date' => '2023-01-01',
        'status' => 'paid',
        'client' => 'Client 1',
        'description' => 'Service 1'
      ],
      (object) [
        'id' => 2,
        'amount' => 200.75,
        'date' => '2023-01-02',
        'status' => 'pending',
        'client' => 'Client 2',
        'description' => 'Service 2'
      ]
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeFactures' => (object) ['facture' => $facturesRaw]
    ]);

    $entities = [
      $this->createEntityMock(Facture::class),
      $this->createEntityMock(Facture::class)
    ];
    $expectedOutput = $this->createDtoMock(ListFacturesOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyFromRawList')
      ->with($facturesRaw)
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())->method('create')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListFactures($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }
}
