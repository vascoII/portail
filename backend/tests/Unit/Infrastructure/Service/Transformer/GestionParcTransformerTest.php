<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\GestionParcTransformer;
use App\Application\Factory\GestionParc\GestionParcEntityFactory;
use App\Application\Factory\GestionParc\GestionParcOutputFactory;
use App\Application\Dto\Output\Immeuble\GetInfosImmeublesOutputDto;
use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosAnomaliesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDysfonctionnementsByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDepannagesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosFuitesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetTableauBordImmeubleOutputDto;

class GestionParcTransformerTest extends BaseTransformerTest
{
  private GestionParcTransformer $transformer;
  private GestionParcEntityFactory|MockInterface $entityFactory;
  private GestionParcOutputFactory|MockInterface $outputFactory;

  protected function setUp(): void
  {
    $this->entityFactory = $this->createFactoryMock(GestionParcEntityFactory::class);
    $this->outputFactory = $this->createFactoryMock(GestionParcOutputFactory::class);
    $this->transformer = new GestionParcTransformer($this->entityFactory, $this->outputFactory);
  }

  public function testTransformFilterResult(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'filter_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformFilterResult($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetInfosImmeublesOutputDto::class, $result);
  }

  public function testTransformIndex(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'index_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformIndex($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetTableauBordClientOutputDto::class, $result);
  }

  public function testTransformIntervention(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'intervention_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformIntervention($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetReportOutputDto::class, $result);
  }

  public function testTransformListAnomalies(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'anomalies_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformListAnomalies($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetInfosAnomaliesByImmeubleOutputDto::class, $result);
  }

  public function testTransformListDysfunctions(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'dysfunctions_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformListDysfunctions($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetInfosDysfonctionnementsByImmeubleOutputDto::class, $result);
  }

  public function testTransformListInterventions(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'interventions_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformListInterventions($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetInfosDepannagesByImmeubleOutputDto::class, $result);
  }

  public function testTransformListLeaks(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'leaks_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformListLeaks($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetInfosFuitesByImmeubleOutputDto::class, $result);
  }

  public function testTransformReport(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'report_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformReport($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetReportOutputDto::class, $result);
  }

  public function testTransformShowIntervention(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'show_intervention_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformShowIntervention($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetInfosDepannagesByImmeubleOutputDto::class, $result);
  }

  public function testTransformShow(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'show_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformShow($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetTableauBordImmeubleOutputDto::class, $result);
  }

  public function testAllMethodsReturnCorrectTypes(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['test' => 'data']);

    // Act & Assert
    $this->assertInstanceOf(GetInfosImmeublesOutputDto::class, $this->transformer->transformFilterResult($dataSourceResult));
    $this->assertInstanceOf(GetTableauBordClientOutputDto::class, $this->transformer->transformIndex($dataSourceResult));
    $this->assertInstanceOf(GetReportOutputDto::class, $this->transformer->transformIntervention($dataSourceResult));
    $this->assertInstanceOf(GetInfosAnomaliesByImmeubleOutputDto::class, $this->transformer->transformListAnomalies($dataSourceResult));
    $this->assertInstanceOf(GetInfosDysfonctionnementsByImmeubleOutputDto::class, $this->transformer->transformListDysfunctions($dataSourceResult));
    $this->assertInstanceOf(GetInfosDepannagesByImmeubleOutputDto::class, $this->transformer->transformListInterventions($dataSourceResult));
    $this->assertInstanceOf(GetInfosFuitesByImmeubleOutputDto::class, $this->transformer->transformListLeaks($dataSourceResult));
    $this->assertInstanceOf(GetReportOutputDto::class, $this->transformer->transformReport($dataSourceResult));
    $this->assertInstanceOf(GetInfosDepannagesByImmeubleOutputDto::class, $this->transformer->transformShowIntervention($dataSourceResult));
    $this->assertInstanceOf(GetTableauBordImmeubleOutputDto::class, $this->transformer->transformShow($dataSourceResult));
  }

  public function testMethodsAreConsistent(): void
  {
    // Arrange
    $dataSourceResult1 = $this->createDataSourceResult(['data' => 'test1']);
    $dataSourceResult2 = $this->createDataSourceResult(['data' => 'test2']);

    // Act
    $result1 = $this->transformer->transformFilterResult($dataSourceResult1);
    $result2 = $this->transformer->transformFilterResult($dataSourceResult2);

    // Assert
    $this->assertEquals(get_class($result1), get_class($result2));
    $this->assertInstanceOf(GetInfosImmeublesOutputDto::class, $result1);
    $this->assertInstanceOf(GetInfosImmeublesOutputDto::class, $result2);
  }

  public function testTransformWithNullData(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([]);

    // Act
    $result = $this->transformer->transformFilterResult($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetInfosImmeublesOutputDto::class, $result);
  }

  public function testTransformWithComplexData(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'complex_data' => [
        'id' => 1,
        'name' => 'Complex Data',
        'description' => 'Complex Description',
        'status' => 'active',
        'createdAt' => '2023-01-01 00:00:00',
        'updatedAt' => '2023-12-31 23:59:59',
        'metadata' => [
          'key1' => 'value1',
          'key2' => 'value2'
        ]
      ]
    ]);

    // Act
    $result = $this->transformer->transformFilterResult($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetInfosImmeublesOutputDto::class, $result);
  }
}
