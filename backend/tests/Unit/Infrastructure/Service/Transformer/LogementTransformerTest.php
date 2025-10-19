<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\LogementTransformer;
use App\Application\Factory\Logement\LogementEntityFactory;
use App\Application\Factory\Logement\LogementOutputFactory;
use App\Application\Dto\Output\Logement\ListLogementsOuputDto;
use App\Application\Dto\Output\Logement\LogementOutputDto;
use App\Domain\Entity\Logement;

class LogementTransformerTest extends BaseTransformerTest
{
  private LogementTransformer $transformer;
  private LogementEntityFactory|MockInterface $entityFactory;
  private LogementOutputFactory|MockInterface $outputFactory;

  protected function setUp(): void
  {
    $this->entityFactory = $this->createFactoryMock(LogementEntityFactory::class);
    $this->outputFactory = $this->createFactoryMock(LogementOutputFactory::class);
    $this->transformer = new LogementTransformer($this->entityFactory, $this->outputFactory);
  }

  public function testTransformListLogementsWithArray(): void
  {
    // Arrange
    $logementsRaw = [
      (object) ['id' => 1, 'name' => 'Logement 1'],
      (object) ['id' => 2, 'name' => 'Logement 2']
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeInfosLogements' => (object) ['infosLogement' => $logementsRaw]
    ]);

    $entities = [
      $this->createEntityMock(Logement::class),
      $this->createEntityMock(Logement::class)
    ];
    $expectedOutput = $this->createDtoMock(ListLogementsOuputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyLogementsFromRawList')
      ->with($logementsRaw)
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())->method('createListLogements')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListLogements($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListLogementsWithSingleObject(): void
  {
    // Arrange
    $logementRaw = (object) ['id' => 1, 'name' => 'Logement 1'];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeInfosLogements' => (object) ['infosLogement' => $logementRaw]
    ]);

    $entities = [$this->createEntityMock(Logement::class)];
    $expectedOutput = $this->createDtoMock(ListLogementsOuputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyLogementsFromRawList')
      ->with([$logementRaw])
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())->method('createListLogements')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListLogements($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListLogementsWithNull(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ListeInfosLogements' => (object) ['infosLogement' => null]
    ]);

    $expectedOutput = $this->createDtoMock(ListLogementsOuputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyLogementsFromRawList')
      ->with([])
      ->willReturn([]);

    $this->outputFactory
      ->expects($this->once())->method('createListLogements')
      ->with([])
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListLogements($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListLogementsWithMissingProperty(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ListeInfosLogements' => (object) []
    ]);

    $expectedOutput = $this->createDtoMock(ListLogementsOuputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyLogementsFromRawList')
      ->with([])
      ->willReturn([]);

    $this->outputFactory
      ->expects($this->once())->method('createListLogements')
      ->with([])
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListLogements($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformGetLogement(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'id' => 1,
      'name' => 'Test Logement'
    ]);

    $entity = $this->createEntityMock(Logement::class);
    $expectedOutput = $this->createDtoMock(LogementOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createLogementFromRaw')
      ->with($dataSourceResult)
      ->willReturn($entity);

    $this->outputFactory
      ->expects($this->once())->method('createGetLogement')
      ->with($entity)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformGetLogement($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformGetLogementWithComplexData(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'id' => 123,
      'name' => 'Complex Logement',
      'address' => '123 Test Street',
      'city' => 'Paris',
      'postalCode' => '75001',
      'active' => true,
      'createdAt' => '2023-01-01 00:00:00',
      'updatedAt' => '2023-12-31 23:59:59',
      'immeubleId' => 456
    ]);

    $entity = $this->createEntityMock(Logement::class);
    $expectedOutput = $this->createDtoMock(LogementOutputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createLogementFromRaw')
      ->with($dataSourceResult)
      ->willReturn($entity);

    $this->outputFactory
      ->expects($this->once())->method('createGetLogement')
      ->with($entity)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformGetLogement($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }

  public function testTransformListLogementsWithComplexData(): void
  {
    // Arrange
    $logementsRaw = [
      (object) [
        'id' => 1,
        'name' => 'Logement 1',
        'address' => '123 Test Street',
        'city' => 'Paris',
        'postalCode' => '75001',
        'active' => true
      ],
      (object) [
        'id' => 2,
        'name' => 'Logement 2',
        'address' => '456 Test Avenue',
        'city' => 'Lyon',
        'postalCode' => '69001',
        'active' => false
      ]
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeInfosLogements' => (object) ['infosLogement' => $logementsRaw]
    ]);

    $entities = [
      $this->createEntityMock(Logement::class),
      $this->createEntityMock(Logement::class)
    ];
    $expectedOutput = $this->createDtoMock(ListLogementsOuputDto::class);

    $this->entityFactory
      ->expects($this->once())->method('createManyLogementsFromRawList')
      ->with($logementsRaw)
      ->willReturn($entities);

    $this->outputFactory
      ->expects($this->once())->method('createListLogements')
      ->with($entities)
      ->willReturn($expectedOutput);

    // Act
    $result = $this->transformer->transformListLogements($dataSourceResult);

    // Assert
    $this->assertSame($expectedOutput, $result);
  }
}
