<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\FrontTransformer;
use App\Application\Factory\Facture\FrontEntityFactory;
use App\Application\Factory\Facture\FrontOutputFactory;
use App\Application\Dto\Output\Admin\GetSousTraitantsOutputDto;
use App\Domain\Entity\SousTraitant;

class FrontTransformerTest extends BaseTransformerTest
{
  private FrontTransformer $transformer;
  private FrontEntityFactory|MockInterface $entityFactory;
  private FrontOutputFactory|MockInterface $outputFactory;

  protected function setUp(): void
  {
    $this->entityFactory = $this->createFactoryMock(FrontEntityFactory::class);
    $this->outputFactory = $this->createFactoryMock(FrontOutputFactory::class);
    $this->transformer = new FrontTransformer($this->entityFactory, $this->outputFactory);
  }

  public function testTransformPersonalDataWithArray(): void
  {
    // Arrange
    $sousTraitantsRaw = [
      (object) [
        'Nom' => 'Sous-traitant 1',
        'Description' => 'Description 1',
        'Territoires' => 'Territoire 1',
        'Pays' => 'France',
        'Adresse' => '123 Test Street',
        'CP' => '75001',
        'Ville' => 'Paris',
        'Protection' => 'Protection 1'
      ],
      (object) [
        'Nom' => 'Sous-traitant 2',
        'Description' => 'Description 2',
        'Territoires' => 'Territoire 2',
        'Pays' => 'France',
        'Adresse' => '456 Test Avenue',
        'CP' => '69001',
        'Ville' => 'Lyon',
        'Protection' => 'Protection 2'
      ]
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeSousTraitant' => (object) ['sousTraitants' => $sousTraitantsRaw]
    ]);

    // Act
    $result = $this->transformer->transformPersonalData($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetSousTraitantsOutputDto::class, $result);
    $this->assertCount(2, $result->sousTraitants);

    $sousTraitant1 = $result->sousTraitants[0];
    $this->assertInstanceOf(SousTraitant::class, $sousTraitant1);
    $this->assertEquals('Sous-traitant 1', $sousTraitant1->nom);
    $this->assertEquals('Description 1', $sousTraitant1->description);
    $this->assertEquals('Territoire 1', $sousTraitant1->territoires);
    $this->assertEquals('France', $sousTraitant1->pays);
    $this->assertEquals('123 Test Street', $sousTraitant1->adresse);
    $this->assertEquals('75001', $sousTraitant1->cp);
    $this->assertEquals('Paris', $sousTraitant1->ville);
    $this->assertEquals('Protection 1', $sousTraitant1->protection);

    $sousTraitant2 = $result->sousTraitants[1];
    $this->assertInstanceOf(SousTraitant::class, $sousTraitant2);
    $this->assertEquals('Sous-traitant 2', $sousTraitant2->nom);
    $this->assertEquals('Description 2', $sousTraitant2->description);
    $this->assertEquals('Territoire 2', $sousTraitant2->territoires);
    $this->assertEquals('France', $sousTraitant2->pays);
    $this->assertEquals('456 Test Avenue', $sousTraitant2->adresse);
    $this->assertEquals('69001', $sousTraitant2->cp);
    $this->assertEquals('Lyon', $sousTraitant2->ville);
    $this->assertEquals('Protection 2', $sousTraitant2->protection);
  }

  public function testTransformPersonalDataWithSingleObject(): void
  {
    // Arrange
    $sousTraitantRaw = (object) [
      'Nom' => 'Sous-traitant 1',
      'Description' => 'Description 1',
      'Territoires' => 'Territoire 1',
      'Pays' => 'France',
      'Adresse' => '123 Test Street',
      'CP' => '75001',
      'Ville' => 'Paris',
      'Protection' => 'Protection 1'
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeSousTraitant' => (object) ['sousTraitants' => $sousTraitantRaw]
    ]);

    // Act
    $result = $this->transformer->transformPersonalData($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetSousTraitantsOutputDto::class, $result);
    $this->assertCount(1, $result->sousTraitants);

    $sousTraitant = $result->sousTraitants[0];
    $this->assertInstanceOf(SousTraitant::class, $sousTraitant);
    $this->assertEquals('Sous-traitant 1', $sousTraitant->nom);
    $this->assertEquals('Description 1', $sousTraitant->description);
    $this->assertEquals('Territoire 1', $sousTraitant->territoires);
    $this->assertEquals('France', $sousTraitant->pays);
    $this->assertEquals('123 Test Street', $sousTraitant->adresse);
    $this->assertEquals('75001', $sousTraitant->cp);
    $this->assertEquals('Paris', $sousTraitant->ville);
    $this->assertEquals('Protection 1', $sousTraitant->protection);
  }

  public function testTransformPersonalDataWithEmptyArray(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ListeSousTraitant' => (object) ['sousTraitants' => []]
    ]);

    // Act
    $result = $this->transformer->transformPersonalData($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetSousTraitantsOutputDto::class, $result);
    $this->assertCount(0, $result->sousTraitants);
  }

  public function testTransformPersonalDataWithMissingProperty(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult([
      'ListeSousTraitant' => (object) []
    ]);

    // Act
    $result = $this->transformer->transformPersonalData($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetSousTraitantsOutputDto::class, $result);
    $this->assertCount(0, $result->sousTraitants);
  }

  public function testTransformPersonalDataWithNullValues(): void
  {
    // Arrange
    $sousTraitantRaw = (object) [
      'Nom' => null,
      'Description' => null,
      'Territoires' => null,
      'Pays' => null,
      'Adresse' => null,
      'CP' => null,
      'Ville' => null,
      'Protection' => null
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeSousTraitant' => (object) ['sousTraitants' => [$sousTraitantRaw]]
    ]);

    // Act
    $result = $this->transformer->transformPersonalData($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetSousTraitantsOutputDto::class, $result);
    $this->assertCount(1, $result->sousTraitants);

    $sousTraitant = $result->sousTraitants[0];
    $this->assertInstanceOf(SousTraitant::class, $sousTraitant);
    $this->assertEquals('', $sousTraitant->nom);
    $this->assertEquals('', $sousTraitant->description);
    $this->assertEquals('', $sousTraitant->territoires);
    $this->assertEquals('', $sousTraitant->pays);
    $this->assertEquals('', $sousTraitant->adresse);
    $this->assertEquals('', $sousTraitant->cp);
    $this->assertEquals('', $sousTraitant->ville);
    $this->assertEquals('', $sousTraitant->protection);
  }

  public function testTransformPersonalDataWithComplexData(): void
  {
    // Arrange
    $sousTraitantsRaw = [
      (object) [
        'Nom' => 'Complex Sous-traitant',
        'Description' => 'Complex Description with special chars: éàçù',
        'Territoires' => 'Territoire Complex',
        'Pays' => 'France',
        'Adresse' => '123 Complex Street, Apt 4B',
        'CP' => '75001',
        'Ville' => 'Paris',
        'Protection' => 'Protection Complex'
      ]
    ];
    $dataSourceResult = $this->createDataSourceResult([
      'ListeSousTraitant' => (object) ['sousTraitants' => $sousTraitantsRaw]
    ]);

    // Act
    $result = $this->transformer->transformPersonalData($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetSousTraitantsOutputDto::class, $result);
    $this->assertCount(1, $result->sousTraitants);

    $sousTraitant = $result->sousTraitants[0];
    $this->assertInstanceOf(SousTraitant::class, $sousTraitant);
    $this->assertEquals('Complex Sous-traitant', $sousTraitant->nom);
    $this->assertEquals('Complex Description with special chars: éàçù', $sousTraitant->description);
    $this->assertEquals('Territoire Complex', $sousTraitant->territoires);
    $this->assertEquals('France', $sousTraitant->pays);
    $this->assertEquals('123 Complex Street, Apt 4B', $sousTraitant->adresse);
    $this->assertEquals('75001', $sousTraitant->cp);
    $this->assertEquals('Paris', $sousTraitant->ville);
    $this->assertEquals('Protection Complex', $sousTraitant->protection);
  }
}
