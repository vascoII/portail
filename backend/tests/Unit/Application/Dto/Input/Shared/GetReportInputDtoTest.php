<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Dto\Input\Shared;

use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Tests\Unit\Application\Dto\BaseDtoTest;

class GetReportInputDtoTest extends BaseDtoTest
{
  public function testConstructorSetsTypeAndParams(): void
  {
    // Arrange
    $testData = $this->getTestData('report');

    // Act
    $dto = new GetReportInputDto($testData['type'], $testData['params']);

    // Assert
    $this->assertDtoProperties($dto, $testData);
  }

  public function testDtoHasExpectedProperties(): void
  {
    // Arrange
    $dto = new GetReportInputDto('', '');

    // Assert
    $this->assertDtoHasProperties($dto, ['type', 'params']);
  }

  public function testDtoPropertiesAreReadonly(): void
  {
    // Arrange
    $dto = new GetReportInputDto('', '');

    // Assert
    $this->assertDtoPropertiesAreReadonly($dto);
  }

  public function testDtoIsImmutable(): void
  {
    // Arrange
    $dto = new GetReportInputDto('', '');

    // Assert
    $this->assertDtoIsImmutable($dto);
  }

  public function testConstructorRequiresTypeAndParams(): void
  {
    // Assert
    $this->assertDtoConstructorRequiresAllParameters(GetReportInputDto::class, ['type', 'params']);
  }

  public function testWithAnomaliesReport(): void
  {
    // Arrange
    $type = 'anomalies';
    $params = '{"dateFrom":"2024-01-01","dateTo":"2024-12-31","immeubleId":123}';

    // Act
    $dto = new GetReportInputDto($type, $params);

    // Assert
    $this->assertEquals($type, $dto->type);
    $this->assertEquals($params, $dto->params);
  }

  public function testWithDysfunctionsReport(): void
  {
    // Arrange
    $type = 'dysfunctions';
    $params = '{"status":"active","priority":"high"}';

    // Act
    $dto = new GetReportInputDto($type, $params);

    // Assert
    $this->assertEquals($type, $dto->type);
    $this->assertEquals($params, $dto->params);
  }

  public function testWithInterventionsReport(): void
  {
    // Arrange
    $type = 'interventions';
    $params = '{"technicianId":456,"dateRange":"lastMonth"}';

    // Act
    $dto = new GetReportInputDto($type, $params);

    // Assert
    $this->assertEquals($type, $dto->type);
    $this->assertEquals($params, $dto->params);
  }

  public function testWithEmptyValues(): void
  {
    // Arrange & Act
    $dto = new GetReportInputDto('', '');

    // Assert
    $this->assertEquals('', $dto->type);
    $this->assertEquals('', $dto->params);
  }

  public function testWithSpecialCharacters(): void
  {
    // Arrange
    $type = 'rapport_spécial';
    $params = '{"filtres":"éàçù","paramètres":"test@example.com"}';

    // Act
    $dto = new GetReportInputDto($type, $params);

    // Assert
    $this->assertEquals($type, $dto->type);
    $this->assertEquals($params, $dto->params);
  }

  public function testDtoIsFinalClass(): void
  {
    // Assert
    $reflection = new \ReflectionClass(GetReportInputDto::class);
    $this->assertTrue($reflection->isFinal(), 'GetReportInputDto should be final');
  }
}
