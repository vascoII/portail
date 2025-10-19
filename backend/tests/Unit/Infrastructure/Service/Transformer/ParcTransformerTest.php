<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\ParcTransformer;
use App\Application\Dto\Output\Parc\GetParcOutputDto;
use App\Application\Dto\Output\Parc\ListParcInterventionsOutputDto;
use App\Application\Dto\Output\Parc\GetParcIndicatorsOutputDto;
use App\Application\Dto\Output\Parc\GetParcCapteurOutputDto;
use App\Application\Dto\Output\Parc\GetParcCETOutputDto;
use App\Application\Dto\Output\Parc\GetParcECOutputDto;
use App\Application\Dto\Output\Parc\GetParcEFOutputDto;
use App\Application\Dto\Output\Parc\GetParcElectOutputDto;
use App\Application\Dto\Output\Parc\GetParcGazOutputDto;
use App\Application\Dto\Output\Parc\GetParcRepartOutputDto;
use App\Application\Dto\Output\Parc\GetParcSerieConsosCompteurGeneralOutputDto;
use App\Application\Dto\Output\Parc\GetParcSerieConsosEAUOutputDto;

class ParcTransformerTest extends BaseTransformerTest
{
  private ParcTransformer $transformer;

  protected function setUp(): void
  {
    $this->transformer = new ParcTransformer();
  }

  public function testTransformGetParc(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'parc_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParc($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcOutputDto::class, $result);
    $this->assertEquals(1, $result->pkParc);
    $this->assertEquals('Parc Principal', $result->nom);
    $this->assertEquals('Description du parc principal', $result->description);
    $this->assertTrue($result->actif);
  }

  public function testTransformListParcInterventions(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'interventions' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformListParcInterventions($dataSourceResult);

    // Assert
    $this->assertInstanceOf(ListParcInterventionsOutputDto::class, $result);
    $this->assertEquals([], $result->interventions);
  }

  public function testTransformGetParcIndicators(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'indicators' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParcIndicators($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcIndicatorsOutputDto::class, $result);
    $this->assertEquals(0, $result->totalInterventions);
    $this->assertEquals(0, $result->totalAnomalies);
    $this->assertEquals(0, $result->totalDysfonctionnements);
    $this->assertEquals(0, $result->totalFuites);
  }

  public function testTransformGetParcCapteur(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'capteurs' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParcCapteur($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcCapteurOutputDto::class, $result);
    $this->assertEquals([], $result->capteurs);
  }

  public function testTransformGetParcCET(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'cet_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParcCET($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcCETOutputDto::class, $result);
    $this->assertEquals(0.0, $result->consommation);
    $this->assertEquals('kWh', $result->unite);
    $this->assertNull($result->dateDebut);
    $this->assertNull($result->dateFin);
  }

  public function testTransformGetParcEC(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ec_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParcEC($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcECOutputDto::class, $result);
    $this->assertEquals(0.0, $result->consommation);
    $this->assertEquals('kWh', $result->unite);
    $this->assertNull($result->dateDebut);
    $this->assertNull($result->dateFin);
  }

  public function testTransformGetParcEF(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ef_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParcEF($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcEFOutputDto::class, $result);
    $this->assertEquals(0.0, $result->consommation);
    $this->assertEquals('kWh', $result->unite);
    $this->assertNull($result->dateDebut);
    $this->assertNull($result->dateFin);
  }

  public function testTransformGetParcElect(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'elect_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParcElect($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcElectOutputDto::class, $result);
    $this->assertEquals(0.0, $result->consommation);
    $this->assertEquals('kWh', $result->unite);
    $this->assertNull($result->dateDebut);
    $this->assertNull($result->dateFin);
  }

  public function testTransformGetParcGaz(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'gaz_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParcGaz($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcGazOutputDto::class, $result);
    $this->assertEquals(0.0, $result->consommation);
    $this->assertEquals('m³', $result->unite);
    $this->assertNull($result->dateDebut);
    $this->assertNull($result->dateFin);
  }

  public function testTransformGetParcRepart(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'repart_data' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParcRepart($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcRepartOutputDto::class, $result);
    $this->assertEquals([], $result->repartitions);
  }

  public function testTransformGetParcSerieConsosCompteurGeneral(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'serie_consos' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParcSerieConsosCompteurGeneral($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcSerieConsosCompteurGeneralOutputDto::class, $result);
    $this->assertEquals([], $result->seriesConsos);
  }

  public function testTransformGetParcSerieConsosEAU(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'serie_consos_eau' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetParcSerieConsosEAU($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcSerieConsosEAUOutputDto::class, $result);
    $this->assertEquals([], $result->seriesConsos);
  }

  public function testAllMethodsReturnCorrectTypes(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['test' => 'data']);

    // Act & Assert
    $this->assertInstanceOf(GetParcOutputDto::class, $this->transformer->transformGetParc($dataSourceResult));
    $this->assertInstanceOf(ListParcInterventionsOutputDto::class, $this->transformer->transformListParcInterventions($dataSourceResult));
    $this->assertInstanceOf(GetParcIndicatorsOutputDto::class, $this->transformer->transformGetParcIndicators($dataSourceResult));
    $this->assertInstanceOf(GetParcCapteurOutputDto::class, $this->transformer->transformGetParcCapteur($dataSourceResult));
    $this->assertInstanceOf(GetParcCETOutputDto::class, $this->transformer->transformGetParcCET($dataSourceResult));
    $this->assertInstanceOf(GetParcECOutputDto::class, $this->transformer->transformGetParcEC($dataSourceResult));
    $this->assertInstanceOf(GetParcEFOutputDto::class, $this->transformer->transformGetParcEF($dataSourceResult));
    $this->assertInstanceOf(GetParcElectOutputDto::class, $this->transformer->transformGetParcElect($dataSourceResult));
    $this->assertInstanceOf(GetParcGazOutputDto::class, $this->transformer->transformGetParcGaz($dataSourceResult));
    $this->assertInstanceOf(GetParcRepartOutputDto::class, $this->transformer->transformGetParcRepart($dataSourceResult));
    $this->assertInstanceOf(GetParcSerieConsosCompteurGeneralOutputDto::class, $this->transformer->transformGetParcSerieConsosCompteurGeneral($dataSourceResult));
    $this->assertInstanceOf(GetParcSerieConsosEAUOutputDto::class, $this->transformer->transformGetParcSerieConsosEAU($dataSourceResult));
  }

  public function testMethodsAreConsistent(): void
  {
    // Arrange
    $dataSourceResult1 = $this->createDataSourceResult(['data' => 'test1']);
    $dataSourceResult2 = $this->createDataSourceResult(['data' => 'test2']);

    // Act
    $result1 = $this->transformer->transformGetParc($dataSourceResult1);
    $result2 = $this->transformer->transformGetParc($dataSourceResult2);

    // Assert
    $this->assertEquals($result1->pkParc, $result2->pkParc);
    $this->assertEquals($result1->nom, $result2->nom);
    $this->assertEquals($result1->description, $result2->description);
    $this->assertEquals($result1->actif, $result2->actif);
  }
}
