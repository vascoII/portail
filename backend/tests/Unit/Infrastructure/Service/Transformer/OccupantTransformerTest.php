<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\OccupantTransformer;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

class OccupantTransformerTest extends BaseTransformerTest
{
  private OccupantTransformer $transformer;

  protected function setUp(): void
  {
    $this->transformer = new OccupantTransformer();
  }

  public function testTransformGetOccupantReleveEau(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'releve_eau' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetOccupantReleveEau($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformGetOccupantReleveRepart(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'releve_repart' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetOccupantReleveRepart($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformGetOccupantReleveNote(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'releve_note' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetOccupantReleveNote($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testTransformGetOccupantIntervention(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'intervention' => 'some_data'
    ]);

    // Act
    $result = $this->transformer->transformGetOccupantIntervention($dataSourceResult);

    // Assert
    $this->assertInstanceOf(SuccessOutputDto::class, $result);
    $this->assertTrue($result->bool);
  }

  public function testAllMethodsReturnSuccessOutputDto(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['test' => 'data']);

    // Act & Assert
    $result1 = $this->transformer->transformGetOccupantReleveEau($dataSourceResult);
    $this->assertInstanceOf(SuccessOutputDto::class, $result1);
    $this->assertTrue($result1->bool);

    $result2 = $this->transformer->transformGetOccupantReleveRepart($dataSourceResult);
    $this->assertInstanceOf(SuccessOutputDto::class, $result2);
    $this->assertTrue($result2->bool);

    $result3 = $this->transformer->transformGetOccupantReleveNote($dataSourceResult);
    $this->assertInstanceOf(SuccessOutputDto::class, $result3);
    $this->assertTrue($result3->bool);

    $result4 = $this->transformer->transformGetOccupantIntervention($dataSourceResult);
    $this->assertInstanceOf(SuccessOutputDto::class, $result4);
    $this->assertTrue($result4->bool);
  }
}
