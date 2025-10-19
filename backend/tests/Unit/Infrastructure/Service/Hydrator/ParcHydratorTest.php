<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Hydrator\ParcHydrator;

class ParcHydratorTest extends BaseHydratorTest
{
  private ParcHydrator $hydrator;

  protected function setUp(): void
  {
    $this->hydrator = new ParcHydrator();
  }

  public function testHydrateGetParc(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParc();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateListParcInterventions(): void
  {
    // Act
    $result = $this->hydrator->hydrateListParcInterventions();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetParcIndicators(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParcIndicators();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetParcCapteur(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParcCapteur();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetParcCET(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParcCET();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetParcEC(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParcEC();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetParcEF(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParcEF();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetParcElect(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParcElect();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetParcGaz(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParcGaz();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetParcRepart(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParcRepart();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetParcSerieConsosCompteurGeneral(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParcSerieConsosCompteurGeneral();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testHydrateGetParcSerieConsosEAU(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParcSerieConsosEAU();

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectPropertyCount($result, 0);
  }

  public function testAllMethodsReturnObjects(): void
  {
    // Act & Assert
    $this->assertIsObject($this->hydrator->hydrateGetParc());
    $this->assertIsObject($this->hydrator->hydrateListParcInterventions());
    $this->assertIsObject($this->hydrator->hydrateGetParcIndicators());
    $this->assertIsObject($this->hydrator->hydrateGetParcCapteur());
    $this->assertIsObject($this->hydrator->hydrateGetParcCET());
    $this->assertIsObject($this->hydrator->hydrateGetParcEC());
    $this->assertIsObject($this->hydrator->hydrateGetParcEF());
    $this->assertIsObject($this->hydrator->hydrateGetParcElect());
    $this->assertIsObject($this->hydrator->hydrateGetParcGaz());
    $this->assertIsObject($this->hydrator->hydrateGetParcRepart());
    $this->assertIsObject($this->hydrator->hydrateGetParcSerieConsosCompteurGeneral());
    $this->assertIsObject($this->hydrator->hydrateGetParcSerieConsosEAU());
  }

  public function testAllMethodsReturnEmptyObjects(): void
  {
    // Act
    $results = [
      $this->hydrator->hydrateGetParc(),
      $this->hydrator->hydrateListParcInterventions(),
      $this->hydrator->hydrateGetParcIndicators(),
      $this->hydrator->hydrateGetParcCapteur(),
      $this->hydrator->hydrateGetParcCET(),
      $this->hydrator->hydrateGetParcEC(),
      $this->hydrator->hydrateGetParcEF(),
      $this->hydrator->hydrateGetParcElect(),
      $this->hydrator->hydrateGetParcGaz(),
      $this->hydrator->hydrateGetParcRepart(),
      $this->hydrator->hydrateGetParcSerieConsosCompteurGeneral(),
      $this->hydrator->hydrateGetParcSerieConsosEAU()
    ];

    // Assert
    foreach ($results as $result) {
      $this->assertHydratedObjectPropertyCount($result, 0);
    }
  }

  public function testHydratedObjectsAreConsistent(): void
  {
    // Act
    $result1 = $this->hydrator->hydrateGetParc();
    $result2 = $this->hydrator->hydrateGetParc();

    // Assert
    $this->assertEquals($result1, $result2);
  }

  public function testAllMethodsAreConsistent(): void
  {
    // Act
    $result1 = $this->hydrator->hydrateGetParc();
    $result2 = $this->hydrator->hydrateListParcInterventions();
    $result3 = $this->hydrator->hydrateGetParcIndicators();

    // Assert - All should be empty objects
    $this->assertEquals($result1, $result2);
    $this->assertEquals($result2, $result3);
  }

  public function testMethodsReturnStdClassObjects(): void
  {
    // Act
    $result = $this->hydrator->hydrateGetParc();

    // Assert
    $this->assertInstanceOf(\stdClass::class, $result);
  }
}
