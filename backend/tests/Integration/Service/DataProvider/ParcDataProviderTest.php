<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service\DataProvider;

use App\Infrastructure\Service\DataProvider\ParcDataProvider;
use App\Application\Service\DataSource\ParcDataSourceInterface;
use App\Application\Service\Transformer\ParcTransformerInterface;
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

class ParcDataProviderTest extends BaseDataProviderTest
{
  private ParcDataSourceInterface $dataSource;
  private ParcTransformerInterface $transformer;
  private ParcDataProvider $dataProvider;

  protected function setUp(): void
  {
    $this->dataSource = $this->createDataSourceMock(ParcDataSourceInterface::class);
    $this->transformer = $this->createTransformerMock(ParcTransformerInterface::class);

    $this->dataProvider = new ParcDataProvider(
      $this->dataSource,
      $this->transformer
    );
  }

  public function testGetParcService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['parc' => ['id' => 1, 'name' => 'Test Parc']]);
    $expectedOutput = new GetParcOutputDto(1, 'Test Parc', 'description', true);

    $this->dataSource
      ->shouldReceive('fetchGetParc')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParc')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcService();

    // Assert
    $this->assertResultType($result, GetParcOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testListParcInterventionsService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['interventions' => []]);
    $expectedOutput = new ListParcInterventionsOutputDto([]);

    $this->dataSource
      ->shouldReceive('fetchListParcInterventions')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformListParcInterventions')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->listParcInterventionsService();

    // Assert
    $this->assertResultType($result, ListParcInterventionsOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetParcIndicatorsService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['indicators' => ['total' => 100]]);
    $expectedOutput = new GetParcIndicatorsOutputDto(100, 50, 25, 10);

    $this->dataSource
      ->shouldReceive('fetchGetParcIndicators')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParcIndicators')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcIndicatorsService();

    // Assert
    $this->assertResultType($result, GetParcIndicatorsOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetParcCapteurService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['capteurs' => []]);
    $expectedOutput = new GetParcCapteurOutputDto([]);

    $this->dataSource
      ->shouldReceive('fetchGetParcCapteur')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParcCapteur')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcCapteurService();

    // Assert
    $this->assertResultType($result, GetParcCapteurOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetParcCETService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['cet' => []]);
    $expectedOutput = new GetParcCETOutputDto(100.5, 'kWh', null, null);

    $this->dataSource
      ->shouldReceive('fetchGetParcCET')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParcCET')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcCETService();

    // Assert
    $this->assertResultType($result, GetParcCETOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetParcECService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['ec' => []]);
    $expectedOutput = new GetParcECOutputDto(200.5, 'kWh', null, null);

    $this->dataSource
      ->shouldReceive('fetchGetParcEC')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParcEC')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcECService();

    // Assert
    $this->assertResultType($result, GetParcECOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetParcEFService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['ef' => []]);
    $expectedOutput = new GetParcEFOutputDto(300.5, 'kWh', null, null);

    $this->dataSource
      ->shouldReceive('fetchGetParcEF')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParcEF')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcEFService();

    // Assert
    $this->assertResultType($result, GetParcEFOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetParcElectService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['elect' => []]);
    $expectedOutput = new GetParcElectOutputDto(400.5, 'kWh', null, null);

    $this->dataSource
      ->shouldReceive('fetchGetParcElect')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParcElect')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcElectService();

    // Assert
    $this->assertResultType($result, GetParcElectOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetParcGazService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['gaz' => []]);
    $expectedOutput = new GetParcGazOutputDto(500.5, 'kWh', null, null);

    $this->dataSource
      ->shouldReceive('fetchGetParcGaz')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParcGaz')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcGazService();

    // Assert
    $this->assertResultType($result, GetParcGazOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetParcRepartService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['repart' => []]);
    $expectedOutput = new GetParcRepartOutputDto([]);

    $this->dataSource
      ->shouldReceive('fetchGetParcRepart')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParcRepart')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcRepartService();

    // Assert
    $this->assertResultType($result, GetParcRepartOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetParcSerieConsosCompteurGeneralService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['serie' => []]);
    $expectedOutput = new GetParcSerieConsosCompteurGeneralOutputDto([]);

    $this->dataSource
      ->shouldReceive('fetchGetParcSerieConsosCompteurGeneral')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParcSerieConsosCompteurGeneral')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcSerieConsosCompteurGeneralService();

    // Assert
    $this->assertResultType($result, GetParcSerieConsosCompteurGeneralOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetParcSerieConsosEAUService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['serie' => []]);
    $expectedOutput = new GetParcSerieConsosEAUOutputDto([]);

    $this->dataSource
      ->shouldReceive('fetchGetParcSerieConsosEAU')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParcSerieConsosEAU')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcSerieConsosEAUService();

    // Assert
    $this->assertResultType($result, GetParcSerieConsosEAUOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testAllMethodsReturnCorrectTypes(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult([]);

    // Setup common mocks
    $this->dataSource->shouldReceive('fetchGetParc')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchListParcInterventions')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetParcIndicators')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetParcCapteur')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetParcCET')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetParcEC')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetParcEF')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetParcElect')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetParcGaz')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetParcRepart')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetParcSerieConsosCompteurGeneral')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetParcSerieConsosEAU')->andReturn($rawData);

    $this->transformer->shouldReceive('transformGetParc')->andReturn(new GetParcOutputDto(1, 'Test', 'desc', true));
    $this->transformer->shouldReceive('transformListParcInterventions')->andReturn(new ListParcInterventionsOutputDto([]));
    $this->transformer->shouldReceive('transformGetParcIndicators')->andReturn(new GetParcIndicatorsOutputDto(100, 50, 25, 10));
    $this->transformer->shouldReceive('transformGetParcCapteur')->andReturn(new GetParcCapteurOutputDto([]));
    $this->transformer->shouldReceive('transformGetParcCET')->andReturn(new GetParcCETOutputDto(100.5, 'kWh', null, null));
    $this->transformer->shouldReceive('transformGetParcEC')->andReturn(new GetParcECOutputDto(200.5, 'kWh', null, null));
    $this->transformer->shouldReceive('transformGetParcEF')->andReturn(new GetParcEFOutputDto(300.5, 'kWh', null, null));
    $this->transformer->shouldReceive('transformGetParcElect')->andReturn(new GetParcElectOutputDto(400.5, 'kWh', null, null));
    $this->transformer->shouldReceive('transformGetParcGaz')->andReturn(new GetParcGazOutputDto(500.5, 'kWh', null, null));
    $this->transformer->shouldReceive('transformGetParcRepart')->andReturn(new GetParcRepartOutputDto([]));
    $this->transformer->shouldReceive('transformGetParcSerieConsosCompteurGeneral')->andReturn(new GetParcSerieConsosCompteurGeneralOutputDto([]));
    $this->transformer->shouldReceive('transformGetParcSerieConsosEAU')->andReturn(new GetParcSerieConsosEAUOutputDto([]));

    // Act & Assert
    $this->assertResultType($this->dataProvider->getParcService(), GetParcOutputDto::class);
    $this->assertResultType($this->dataProvider->listParcInterventionsService(), ListParcInterventionsOutputDto::class);
    $this->assertResultType($this->dataProvider->getParcIndicatorsService(), GetParcIndicatorsOutputDto::class);
    $this->assertResultType($this->dataProvider->getParcCapteurService(), GetParcCapteurOutputDto::class);
    $this->assertResultType($this->dataProvider->getParcCETService(), GetParcCETOutputDto::class);
    $this->assertResultType($this->dataProvider->getParcECService(), GetParcECOutputDto::class);
    $this->assertResultType($this->dataProvider->getParcEFService(), GetParcEFOutputDto::class);
    $this->assertResultType($this->dataProvider->getParcElectService(), GetParcElectOutputDto::class);
    $this->assertResultType($this->dataProvider->getParcGazService(), GetParcGazOutputDto::class);
    $this->assertResultType($this->dataProvider->getParcRepartService(), GetParcRepartOutputDto::class);
    $this->assertResultType($this->dataProvider->getParcSerieConsosCompteurGeneralService(), GetParcSerieConsosCompteurGeneralOutputDto::class);
    $this->assertResultType($this->dataProvider->getParcSerieConsosEAUService(), GetParcSerieConsosEAUOutputDto::class);
  }

  public function testDataFlowIntegration(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['parc' => ['id' => 1, 'name' => 'Test Parc']]);
    $expectedOutput = new GetParcOutputDto(1, 'Test Parc', 'description', true);

    // Verify the complete data flow
    $this->dataSource
      ->shouldReceive('fetchGetParc')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParc')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getParcService();

    // Assert - Verify the complete integration
    $this->assertEquals($expectedOutput, $result);
    $this->assertResultType($result, GetParcOutputDto::class);
  }

  public function testConsistencyAcrossMultipleCalls(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['parc' => ['id' => 1, 'name' => 'Test Parc']]);
    $expectedOutput = new GetParcOutputDto(1, 'Test Parc', 'description', true);

    $this->dataSource
      ->shouldReceive('fetchGetParc')
      ->times(3)
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetParc')
      ->with($rawData)
      ->times(3)
      ->andReturn($expectedOutput);

    // Act
    $result1 = $this->dataProvider->getParcService();
    $result2 = $this->dataProvider->getParcService();
    $result3 = $this->dataProvider->getParcService();

    // Assert
    $this->assertEquals($result1, $result2);
    $this->assertEquals($result2, $result3);
    $this->assertResultType($result1, GetParcOutputDto::class);
  }
}
