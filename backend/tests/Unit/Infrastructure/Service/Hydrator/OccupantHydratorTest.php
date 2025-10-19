<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Hydrator\OccupantHydrator;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;

class OccupantHydratorTest extends BaseHydratorTest
{
  private OccupantHydrator $hydrator;

  protected function setUp(): void
  {
    $this->hydrator = new OccupantHydrator();
  }

  public function testHydrateGetOccupantReleveEau(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetOccupantReleveEau();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetOccupantReleveRepart(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetOccupantReleveRepart();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetOccupantReleveNote(): void
  {
    // Arrange
    $inputDto = new GetByEnergyStringInputDto('electricity');

    // Act
    $result = $this->hydrator->hydrateGetOccupantReleveNote($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'Energy' => 'electricity'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateGetOccupantIntervention(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetOccupantIntervention($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'Id' => 123
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateGetOccupantReleveNoteWithDifferentEnergies(): void
  {
    // Arrange
    $inputDto1 = new GetByEnergyStringInputDto('electricity');
    $inputDto2 = new GetByEnergyStringInputDto('gas');
    $inputDto3 = new GetByEnergyStringInputDto('water');

    // Act
    $result1 = $this->hydrator->hydrateGetOccupantReleveNote($inputDto1);
    $result2 = $this->hydrator->hydrateGetOccupantReleveNote($inputDto2);
    $result3 = $this->hydrator->hydrateGetOccupantReleveNote($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, ['Energy' => 'electricity']);
    $this->assertHydratedObjectHasProperties($result2, ['Energy' => 'gas']);
    $this->assertHydratedObjectHasProperties($result3, ['Energy' => 'water']);
  }

  public function testHydrateGetOccupantInterventionWithDifferentIds(): void
  {
    // Arrange
    $inputDto1 = new GetByIdIntInputDto(123);
    $inputDto2 = new GetByIdIntInputDto(456);
    $inputDto3 = new GetByIdIntInputDto(789);

    // Act
    $result1 = $this->hydrator->hydrateGetOccupantIntervention($inputDto1);
    $result2 = $this->hydrator->hydrateGetOccupantIntervention($inputDto2);
    $result3 = $this->hydrator->hydrateGetOccupantIntervention($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, ['Id' => 123]);
    $this->assertHydratedObjectHasProperties($result2, ['Id' => 456]);
    $this->assertHydratedObjectHasProperties($result3, ['Id' => 789]);
  }

  public function testAllMethodsReturnObjects(): void
  {
    // Arrange
    $energyInput = new GetByEnergyStringInputDto('electricity');
    $idInput = new GetByIdIntInputDto(123);

    // Act & Assert
    $this->assertIsObject($this->hydrator->hydrateGetOccupantReleveEau());
    $this->assertIsObject($this->hydrator->hydrateGetOccupantReleveRepart());
    $this->assertIsObject($this->hydrator->hydrateGetOccupantReleveNote($energyInput));
    $this->assertIsObject($this->hydrator->hydrateGetOccupantIntervention($idInput));
  }

  public function testHydratedObjectsAreConsistent(): void
  {
    // Arrange
    $inputDto = new GetByEnergyStringInputDto('electricity');

    // Act
    $result1 = $this->hydrator->hydrateGetOccupantReleveNote($inputDto);
    $result2 = $this->hydrator->hydrateGetOccupantReleveNote($inputDto);

    // Assert
    $this->assertEquals($result1, $result2);
  }

  public function testEmptyMethodsReturnEmptyObjects(): void
  {
    // Act
    $result1 = $this->hydrator->hydrateGetOccupantReleveEau();
    $result2 = $this->hydrator->hydrateGetOccupantReleveRepart();

    // Assert
    $this->assertHydratedObjectPropertyCount($result1, 0);
    $this->assertHydratedObjectPropertyCount($result2, 0);
  }

  public function testMethodsWithParametersReturnObjectsWithData(): void
  {
    // Arrange
    $energyInput = new GetByEnergyStringInputDto('electricity');
    $idInput = new GetByIdIntInputDto(123);

    // Act
    $energyResult = $this->hydrator->hydrateGetOccupantReleveNote($energyInput);
    $idResult = $this->hydrator->hydrateGetOccupantIntervention($idInput);

    // Assert
    $this->assertGreaterThan(0, count(get_object_vars($energyResult)));
    $this->assertGreaterThan(0, count(get_object_vars($idResult)));
  }

  public function testHydratedObjectsHaveCorrectPropertyTypes(): void
  {
    // Arrange
    $energyInput = new GetByEnergyStringInputDto('electricity');
    $idInput = new GetByIdIntInputDto(123);

    // Act
    $energyResult = $this->hydrator->hydrateGetOccupantReleveNote($energyInput);
    $idResult = $this->hydrator->hydrateGetOccupantIntervention($idInput);

    // Assert
    $this->assertHydratedObjectPropertyTypes($energyResult, [
      'Energy' => 'string'
    ]);
    $this->assertHydratedObjectPropertyTypes($idResult, [
      'Id' => 'int'
    ]);
  }

  public function testMethodsReturnStdClassObjects(): void
  {
    // Arrange
    $energyInput = new GetByEnergyStringInputDto('electricity');

    // Act
    $result = $this->hydrator->hydrateGetOccupantReleveNote($energyInput);

    // Assert
    $this->assertInstanceOf(\stdClass::class, $result);
  }
}
