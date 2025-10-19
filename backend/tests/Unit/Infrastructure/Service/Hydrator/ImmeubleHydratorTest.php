<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Hydrator\ImmeubleHydrator;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

class ImmeubleHydratorTest extends BaseHydratorTest
{
  private ImmeubleHydrator $hydrator;

  protected function setUp(): void
  {
    $this->hydrator = new ImmeubleHydrator();
  }

  public function testHydrateGetListImmeubles(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetListImmeubles();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkUserChild' => -1,
      'ParamsInfos' => 'NBCOMPTEURS=O|NBFUITES=O|NBDEPANNAGES=O|NBDYSFONCTIONNEMENTS=O|NBANOMALIES=O',
      'ParamsFiltres' => ''
    ]);
    $this->assertHydratedObjectPropertyCount($result, 3);
  }

  public function testHydrateGetImmeuble(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetImmeuble($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkImmeuble' => 123
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateListAnomaliesByImmeuble(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(456);

    // Act
    $result = $this->hydrator->hydrateListAnomaliesByImmeuble($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkImmeuble' => 456,
      'ParamsFiltres' => ''
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateListDysfonctionnementsByImmeuble(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(789);

    // Act
    $result = $this->hydrator->hydrateListDysfonctionnementsByImmeuble($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkImmeuble' => 789,
      'ParamsFiltres' => ''
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateListFuitesByImmeuble(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(111);

    // Act
    $result = $this->hydrator->hydrateListFuitesByImmeuble($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkImmeuble' => 111,
      'ParamsFiltres' => ''
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateListInterventionsByImmeuble(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(222);

    // Act
    $result = $this->hydrator->hydrateListInterventionsByImmeuble($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkImmeuble' => 222,
      'ParamsFiltres' => ''
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateListLogementsByImmeuble(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(333);

    // Act
    $result = $this->hydrator->hydrateListLogementsByImmeuble($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkImmeuble' => 333,
      'ParamsFiltres' => '',
      'ParamsInfos' => ''
    ]);
    $this->assertHydratedObjectPropertyCount($result, 3);
  }

  public function testHydrateListDysfonctionnementsByLogement(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(444);

    // Act
    $result = $this->hydrator->hydrateListDysfonctionnementsByLogement($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkImmeuble' => 444,
      'ParamsFiltres' => ''
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetListImmeublesWithFixedValues(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetListImmeubles();

    // Assert
    $this->assertHydratedObjectContainsValues($result, [
      -1,
      'NBCOMPTEURS=O|NBFUITES=O|NBDEPANNAGES=O|NBDYSFONCTIONNEMENTS=O|NBANOMALIES=O',
      ''
    ]);
  }

  public function testAllMethodsWithSameInputReturnConsistentResults(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $anomaliesResult = $this->hydrator->hydrateListAnomaliesByImmeuble($inputDto);
    $dysfonctionnementsResult = $this->hydrator->hydrateListDysfonctionnementsByImmeuble($inputDto);
    $fuitesResult = $this->hydrator->hydrateListFuitesByImmeuble($inputDto);
    $interventionsResult = $this->hydrator->hydrateListInterventionsByImmeuble($inputDto);
    $dysfonctionnementsLogementResult = $this->hydrator->hydrateListDysfonctionnementsByLogement($inputDto);

    // Assert - All should have the same structure (PkImmeuble + ParamsFiltres)
    $this->assertEquals($anomaliesResult, $dysfonctionnementsResult);
    $this->assertEquals($dysfonctionnementsResult, $fuitesResult);
    $this->assertEquals($fuitesResult, $interventionsResult);
    $this->assertEquals($interventionsResult, $dysfonctionnementsLogementResult);
  }

  public function testAllMethodsWithDifferentInputsReturnDifferentValues(): void
  {
    // Arrange
    $inputDto1 = new GetByIdIntInputDto(123);
    $inputDto2 = new GetByIdIntInputDto(456);
    $inputDto3 = new GetByIdIntInputDto(789);

    // Act
    $result1 = $this->hydrator->hydrateGetImmeuble($inputDto1);
    $result2 = $this->hydrator->hydrateGetImmeuble($inputDto2);
    $result3 = $this->hydrator->hydrateGetImmeuble($inputDto3);

    // Assert
    $this->assertNotEquals($result1, $result2);
    $this->assertNotEquals($result2, $result3);
    $this->assertNotEquals($result1, $result3);
  }

  public function testAllMethodsReturnObjects(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act & Assert
    $this->assertIsObject($this->hydrator->hydrateGetListImmeubles());
    $this->assertIsObject($this->hydrator->hydrateGetImmeuble($inputDto));
    $this->assertIsObject($this->hydrator->hydrateListAnomaliesByImmeuble($inputDto));
    $this->assertIsObject($this->hydrator->hydrateListDysfonctionnementsByImmeuble($inputDto));
    $this->assertIsObject($this->hydrator->hydrateListFuitesByImmeuble($inputDto));
    $this->assertIsObject($this->hydrator->hydrateListInterventionsByImmeuble($inputDto));
    $this->assertIsObject($this->hydrator->hydrateListLogementsByImmeuble($inputDto));
    $this->assertIsObject($this->hydrator->hydrateListDysfonctionnementsByLogement($inputDto));
  }

  public function testHydratedObjectsAreConsistent(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result1 = $this->hydrator->hydrateGetImmeuble($inputDto);
    $result2 = $this->hydrator->hydrateGetImmeuble($inputDto);

    // Assert
    $this->assertEquals($result1, $result2);
  }

  public function testHydratedObjectsHaveCorrectPropertyTypes(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetImmeuble($inputDto);

    // Assert
    $this->assertHydratedObjectPropertyTypes($result, [
      'PkImmeuble' => 'int'
    ]);
  }

  public function testMethodsReturnStdClassObjects(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetImmeuble($inputDto);

    // Assert
    $this->assertInstanceOf(\stdClass::class, $result);
  }

  public function testListLogementsByImmeubleHasThreeProperties(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateListLogementsByImmeuble($inputDto);

    // Assert
    $this->assertHydratedObjectPropertyCount($result, 3);
    $this->assertHydratedObjectStructure($result, ['PkImmeuble', 'ParamsFiltres', 'ParamsInfos']);
  }

  public function testGetListImmeublesHasThreeProperties(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetListImmeubles();

    // Assert
    $this->assertHydratedObjectPropertyCount($result, 3);
    $this->assertHydratedObjectStructure($result, ['PkUserChild', 'ParamsInfos', 'ParamsFiltres']);
  }
}
