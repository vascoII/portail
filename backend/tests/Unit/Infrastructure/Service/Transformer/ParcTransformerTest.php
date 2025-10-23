<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Transformer;

use App\Infrastructure\Service\Transformer\ParcTransformer;
use App\Application\Dto\Output\Parc\GetParcOutputDto;

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
      'NbImmeubles' => 26,
      'NbImmeublesTelereleve' => 2,
      'NbImmeublesTransfertFichiers' => 1,
      'NbCompteursARelever' => 2571,
      'NbCompteursReleves' => 2427,
      'NbLogements' => 1505,
      'NbCompteurs' => 2744,
      'NbCompteursEC' => 1403,
      'NbCompteursEF' => 1341,
      'NbCompteursRepart' => 0,
      'NbCompteursCET' => 0,
      'NbCompteursCapteur' => 0,
      'NbCompteursElect' => -1,
      'NbCompteursGaz' => -1,
      'NbFuites' => 12,
      'DegresFuites' => -1,
      'NbDepannages' => 0,
      'DegresDepannages' => -1,
      'NbDysfonctionnements' => 1,
      'DegresDysfonctionnements' => -1,
      'NbAnomalies' => 171,
      'DegresAnomalies' => -1,
      'NbChantiers' => 0,
      'NbCompteursPoses' => 0,
      'NbCompteursCommandes' => 0,
      'PcImmeublesTelereleve' => 94,
      'PcImmeublesTransfertFichiers' => 4
    ]);

    // Act
    $result = $this->transformer->transformGetParc($dataSourceResult);

    // Assert
    $this->assertInstanceOf(GetParcOutputDto::class, $result);
    $this->assertEquals(26, $result->nbImmeubles);
    $this->assertEquals(2, $result->nbImmeublesTelereleve);
    $this->assertEquals(1, $result->nbImmeublesTransfertFichiers);
    $this->assertEquals(2571, $result->nbCompteursARelever);
    $this->assertEquals(2427, $result->nbCompteursReleves);
    $this->assertEquals(1505, $result->nbLogements);
    $this->assertEquals(2744, $result->nbCompteurs);
    $this->assertEquals(1403, $result->nbCompteursEC);
    $this->assertEquals(1341, $result->nbCompteursEF);
    $this->assertEquals(0, $result->nbCompteursRepart);
    $this->assertEquals(0, $result->nbCompteursCET);
    $this->assertEquals(0, $result->nbCompteursCapteur);
    $this->assertEquals(-1, $result->nbCompteursElect);
    $this->assertEquals(-1, $result->nbCompteursGaz);
    $this->assertEquals(12, $result->nbFuites);
    $this->assertEquals(-1, $result->degresFuites);
    $this->assertEquals(0, $result->nbDepannages);
    $this->assertEquals(-1, $result->degresDepannages);
    $this->assertEquals(1, $result->nbDysfonctionnements);
    $this->assertEquals(-1, $result->degresDysfonctionnements);
    $this->assertEquals(171, $result->nbAnomalies);
    $this->assertEquals(-1, $result->degresAnomalies);
    $this->assertEquals(0, $result->nbChantiers);
    $this->assertEquals(0, $result->nbCompteursPoses);
    $this->assertEquals(0, $result->nbCompteursCommandes);
    $this->assertEquals(94, $result->pcImmeublesTelereleve);
    $this->assertEquals(4, $result->pcImmeublesTransfertFichiers);
  }

  public function testAllMethodsReturnCorrectTypes(): void
  {
    // Arrange
    $dataSourceResult = $this->createDataSourceResult(['test' => 'data']);

    // Act & Assert
    $this->assertInstanceOf(GetParcOutputDto::class, $this->transformer->transformGetParc($dataSourceResult));
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
    $this->assertEquals($result1->nbImmeubles, $result2->nbImmeubles);
    $this->assertEquals($result1->nbImmeublesTelereleve, $result2->nbImmeublesTelereleve);
    $this->assertEquals($result1->nbImmeublesTransfertFichiers, $result2->nbImmeublesTransfertFichiers);
    $this->assertEquals($result1->nbCompteursARelever, $result2->nbCompteursARelever);
    $this->assertEquals($result1->nbCompteursReleves, $result2->nbCompteursReleves);
    $this->assertEquals($result1->nbLogements, $result2->nbLogements);
    $this->assertEquals($result1->nbCompteurs, $result2->nbCompteurs);
    $this->assertEquals($result1->nbCompteursEC, $result2->nbCompteursEC);
    $this->assertEquals($result1->nbCompteursEF, $result2->nbCompteursEF);
    $this->assertEquals($result1->nbCompteursRepart, $result2->nbCompteursRepart);
    $this->assertEquals($result1->nbCompteursCET, $result2->nbCompteursCET);
    $this->assertEquals($result1->nbCompteursCapteur, $result2->nbCompteursCapteur);
    $this->assertEquals($result1->nbCompteursElect, $result2->nbCompteursElect);
    $this->assertEquals($result1->nbCompteursGaz, $result2->nbCompteursGaz);
    $this->assertEquals($result1->nbFuites, $result2->nbFuites);
    $this->assertEquals($result1->degresFuites, $result2->degresFuites);
    $this->assertEquals($result1->nbDepannages, $result2->nbDepannages);
    $this->assertEquals($result1->degresDepannages, $result2->degresDepannages);
    $this->assertEquals($result1->nbDysfonctionnements, $result2->nbDysfonctionnements);
    $this->assertEquals($result1->degresDysfonctionnements, $result2->degresDysfonctionnements);
    $this->assertEquals($result1->nbAnomalies, $result2->nbAnomalies);
    $this->assertEquals($result1->degresAnomalies, $result2->degresAnomalies);
    $this->assertEquals($result1->nbChantiers, $result2->nbChantiers);
    $this->assertEquals($result1->nbCompteursPoses, $result2->nbCompteursPoses);
    $this->assertEquals($result1->nbCompteursCommandes, $result2->nbCompteursCommandes);
    $this->assertEquals($result1->pcImmeublesTelereleve, $result2->pcImmeublesTelereleve);
    $this->assertEquals($result1->pcImmeublesTransfertFichiers, $result2->pcImmeublesTransfertFichiers);
  }
}
