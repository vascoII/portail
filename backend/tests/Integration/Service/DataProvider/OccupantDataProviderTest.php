<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service\DataProvider;

use App\Infrastructure\Service\DataProvider\OccupantDataProvider;
use App\Application\Service\DataSource\OccupantDataSourceInterface;
use App\Application\Service\Transformer\OccupantTransformerInterface;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

class OccupantDataProviderTest extends BaseDataProviderTest
{
  private OccupantDataSourceInterface $dataSource;
  private OccupantTransformerInterface $transformer;
  private OccupantDataProvider $dataProvider;

  protected function setUp(): void
  {
    $this->dataSource = $this->createDataSourceMock(OccupantDataSourceInterface::class);
    $this->transformer = $this->createTransformerMock(OccupantTransformerInterface::class);

    $this->dataProvider = new OccupantDataProvider(
      $this->dataSource,
      $this->transformer
    );
  }

  public function testGetOccupantReleveEauService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchGetOccupantReleveEau')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetOccupantReleveEau')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getOccupantReleveEauService();

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetOccupantReleveRepartService(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchGetOccupantReleveRepart')
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetOccupantReleveRepart')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getOccupantReleveRepartService();

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetOccupantReleveNoteService(): void
  {
    // Arrange
    $inputDto = new GetByEnergyStringInputDto('electricity');
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchGetOccupantReleveNote')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetOccupantReleveNote')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getOccupantReleveNoteService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testGetOccupantInterventionService(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchGetOccupantIntervention')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetOccupantIntervention')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getOccupantInterventionService($inputDto);

    // Assert
    $this->assertResultType($result, SuccessOutputDto::class);
    $this->assertEquals($expectedOutput, $result);
  }

  public function testAllMethodsReturnCorrectTypes(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);
    $energyInput = new GetByEnergyStringInputDto('electricity');
    $idInput = new GetByIdIntInputDto(123);

    // Setup common mocks
    $this->dataSource->shouldReceive('fetchGetOccupantReleveEau')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetOccupantReleveRepart')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetOccupantReleveNote')->andReturn($rawData);
    $this->dataSource->shouldReceive('fetchGetOccupantIntervention')->andReturn($rawData);

    $this->transformer->shouldReceive('transformGetOccupantReleveEau')->andReturn($expectedOutput);
    $this->transformer->shouldReceive('transformGetOccupantReleveRepart')->andReturn($expectedOutput);
    $this->transformer->shouldReceive('transformGetOccupantReleveNote')->andReturn($expectedOutput);
    $this->transformer->shouldReceive('transformGetOccupantIntervention')->andReturn($expectedOutput);

    // Act & Assert
    $this->assertResultType($this->dataProvider->getOccupantReleveEauService(), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->getOccupantReleveRepartService(), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->getOccupantReleveNoteService($energyInput), SuccessOutputDto::class);
    $this->assertResultType($this->dataProvider->getOccupantInterventionService($idInput), SuccessOutputDto::class);
  }

  public function testDataFlowIntegration(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    // Verify the complete data flow
    $this->dataSource
      ->shouldReceive('fetchGetOccupantIntervention')
      ->with($inputDto)
      ->once()
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetOccupantIntervention')
      ->with($rawData)
      ->once()
      ->andReturn($expectedOutput);

    // Act
    $result = $this->dataProvider->getOccupantInterventionService($inputDto);

    // Assert - Verify the complete integration
    $this->assertEquals($expectedOutput, $result);
    $this->assertResultType($result, SuccessOutputDto::class);
  }

  public function testConsistencyAcrossMultipleCalls(): void
  {
    // Arrange
    $rawData = $this->createDataSourceResult(['success' => true]);
    $expectedOutput = new SuccessOutputDto(true);

    $this->dataSource
      ->shouldReceive('fetchGetOccupantReleveEau')
      ->times(3)
      ->andReturn($rawData);

    $this->transformer
      ->shouldReceive('transformGetOccupantReleveEau')
      ->with($rawData)
      ->times(3)
      ->andReturn($expectedOutput);

    // Act
    $result1 = $this->dataProvider->getOccupantReleveEauService();
    $result2 = $this->dataProvider->getOccupantReleveEauService();
    $result3 = $this->dataProvider->getOccupantReleveEauService();

    // Assert
    $this->assertEquals($result1, $result2);
    $this->assertEquals($result2, $result3);
    $this->assertResultType($result1, SuccessOutputDto::class);
  }
}
