<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Hydrator\LogementHydrator;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

class LogementHydratorTest extends BaseHydratorTest
{
  private LogementHydrator $hydrator;

  protected function setUp(): void
  {
    $this->hydrator = new LogementHydrator();
  }

  public function testHydrateGetLogement(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetLogement($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkLogement' => 123,
      'PkOccupant' => -1
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetLogementCapteur(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(456);

    // Act
    $result = $this->hydrator->hydrateGetLogementCapteur($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkLogement' => 456,
      'PkOccupant' => -1
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetLogementCET(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(789);

    // Act
    $result = $this->hydrator->hydrateGetLogementCET($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkLogement' => 789,
      'PkOccupant' => -1
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetLogementEC(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(111);

    // Act
    $result = $this->hydrator->hydrateGetLogementEC($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkLogement' => 111,
      'PkOccupant' => -1
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetLogementEF(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(222);

    // Act
    $result = $this->hydrator->hydrateGetLogementEF($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkLogement' => 222,
      'PkOccupant' => -1
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetLogementElect(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(333);

    // Act
    $result = $this->hydrator->hydrateGetLogementElect($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkLogement' => 333,
      'PkOccupant' => -1
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetLogementGaz(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(444);

    // Act
    $result = $this->hydrator->hydrateGetLogementGaz($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkLogement' => 444,
      'PkOccupant' => -1
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetLogementRepart(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(555);

    // Act
    $result = $this->hydrator->hydrateGetLogementRepart($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'PkLogement' => 555,
      'PkOccupant' => -1
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testAllMethodsWithSameInputReturnSameStructure(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $getResult = $this->hydrator->hydrateGetLogement($inputDto);
    $capteurResult = $this->hydrator->hydrateGetLogementCapteur($inputDto);
    $cetResult = $this->hydrator->hydrateGetLogementCET($inputDto);
    $ecResult = $this->hydrator->hydrateGetLogementEC($inputDto);
    $efResult = $this->hydrator->hydrateGetLogementEF($inputDto);
    $electResult = $this->hydrator->hydrateGetLogementElect($inputDto);
    $gazResult = $this->hydrator->hydrateGetLogementGaz($inputDto);
    $repartResult = $this->hydrator->hydrateGetLogementRepart($inputDto);

    // Assert - All should have the same structure
    $this->assertEquals($getResult, $capteurResult);
    $this->assertEquals($capteurResult, $cetResult);
    $this->assertEquals($cetResult, $ecResult);
    $this->assertEquals($ecResult, $efResult);
    $this->assertEquals($efResult, $electResult);
    $this->assertEquals($electResult, $gazResult);
    $this->assertEquals($gazResult, $repartResult);
  }

  public function testAllMethodsWithDifferentInputsReturnDifferentValues(): void
  {
    // Arrange
    $inputDto1 = new GetByIdIntInputDto(123);
    $inputDto2 = new GetByIdIntInputDto(456);
    $inputDto3 = new GetByIdIntInputDto(789);

    // Act
    $result1 = $this->hydrator->hydrateGetLogement($inputDto1);
    $result2 = $this->hydrator->hydrateGetLogement($inputDto2);
    $result3 = $this->hydrator->hydrateGetLogement($inputDto3);

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
    $this->assertIsObject($this->hydrator->hydrateGetLogement($inputDto));
    $this->assertIsObject($this->hydrator->hydrateGetLogementCapteur($inputDto));
    $this->assertIsObject($this->hydrator->hydrateGetLogementCET($inputDto));
    $this->assertIsObject($this->hydrator->hydrateGetLogementEC($inputDto));
    $this->assertIsObject($this->hydrator->hydrateGetLogementEF($inputDto));
    $this->assertIsObject($this->hydrator->hydrateGetLogementElect($inputDto));
    $this->assertIsObject($this->hydrator->hydrateGetLogementGaz($inputDto));
    $this->assertIsObject($this->hydrator->hydrateGetLogementRepart($inputDto));
  }

  public function testHydratedObjectsAreConsistent(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result1 = $this->hydrator->hydrateGetLogement($inputDto);
    $result2 = $this->hydrator->hydrateGetLogement($inputDto);

    // Assert
    $this->assertEquals($result1, $result2);
  }

  public function testHydratedObjectsHaveCorrectPropertyTypes(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetLogement($inputDto);

    // Assert
    $this->assertHydratedObjectPropertyTypes($result, [
      'PkLogement' => 'int',
      'PkOccupant' => 'int'
    ]);
  }

  public function testMethodsReturnStdClassObjects(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $result = $this->hydrator->hydrateGetLogement($inputDto);

    // Assert
    $this->assertInstanceOf(\stdClass::class, $result);
  }

  public function testAllMethodsHaveSamePropertyCount(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $results = [
      $this->hydrator->hydrateGetLogement($inputDto),
      $this->hydrator->hydrateGetLogementCapteur($inputDto),
      $this->hydrator->hydrateGetLogementCET($inputDto),
      $this->hydrator->hydrateGetLogementEC($inputDto),
      $this->hydrator->hydrateGetLogementEF($inputDto),
      $this->hydrator->hydrateGetLogementElect($inputDto),
      $this->hydrator->hydrateGetLogementGaz($inputDto),
      $this->hydrator->hydrateGetLogementRepart($inputDto)
    ];

    // Assert
    foreach ($results as $result) {
      $this->assertHydratedObjectPropertyCount($result, 2);
    }
  }

  public function testAllMethodsContainPkOccupantDefaultValue(): void
  {
    // Arrange
    $inputDto = new GetByIdIntInputDto(123);

    // Act
    $results = [
      $this->hydrator->hydrateGetLogement($inputDto),
      $this->hydrator->hydrateGetLogementCapteur($inputDto),
      $this->hydrator->hydrateGetLogementCET($inputDto),
      $this->hydrator->hydrateGetLogementEC($inputDto),
      $this->hydrator->hydrateGetLogementEF($inputDto),
      $this->hydrator->hydrateGetLogementElect($inputDto),
      $this->hydrator->hydrateGetLogementGaz($inputDto),
      $this->hydrator->hydrateGetLogementRepart($inputDto)
    ];

    // Assert
    foreach ($results as $result) {
      $this->assertHydratedObjectContainsValues($result, [-1]);
    }
  }
}
