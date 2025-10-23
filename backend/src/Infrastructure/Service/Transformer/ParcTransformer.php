<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Service\Transformer\ParcTransformerInterface;
use App\Application\Dto\Output\Parc\GetParcOutputDto;

final class ParcTransformer implements ParcTransformerInterface
{
  public function transformGetParc(object $dataSourceResult): GetParcOutputDto
  {
    return new GetParcOutputDto(
      nbImmeubles: $dataSourceResult->NbImmeubles,
      nbImmeublesTelereleve: $dataSourceResult->NbImmeublesTelereleve,
      nbImmeublesTransfertFichiers: $dataSourceResult->NbImmeublesTransfertFichiers,
      nbCompteursARelever: $dataSourceResult->NbCompteursARelever,
      nbCompteursReleves: $dataSourceResult->NbCompteursReleves,
      nbLogements: $dataSourceResult->NbLogements,
      nbCompteurs: $dataSourceResult->NbCompteurs,
      nbCompteursEC: $dataSourceResult->NbCompteursEC,
      nbCompteursEF: $dataSourceResult->NbCompteursEF,
      nbCompteursRepart: $dataSourceResult->NbCompteursRepart,
      nbCompteursCET: $dataSourceResult->NbCompteursCET,
      nbCompteursCapteur: $dataSourceResult->NbCompteursCapteur,
      nbCompteursElect: $dataSourceResult->NbCompteursElect,
      nbCompteursGaz: $dataSourceResult->NbCompteursGaz,
      nbFuites: $dataSourceResult->NbFuites,
      degresFuites: $dataSourceResult->DegresFuites,
      nbDepannages: $dataSourceResult->NbDepannages,
      degresDepannages: $dataSourceResult->DegresDepannages,
      nbDysfonctionnements: $dataSourceResult->NbDysfonctionnements,
      degresDysfonctionnements: $dataSourceResult->DegresDysfonctionnements,
      nbAnomalies: $dataSourceResult->NbAnomalies,
      degresAnomalies: $dataSourceResult->DegresAnomalies,
      nbChantiers: $dataSourceResult->NbChantiers,
      nbCompteursPoses: $dataSourceResult->NbCompteursPoses,
      nbCompteursCommandes: $dataSourceResult->NbCompteursCommandes,
      pcImmeublesTelereleve: (int) ($dataSourceResult->NbCompteursARelever > 0 ? round((100 * $dataSourceResult->NbCompteursReleves) / $dataSourceResult->NbCompteursARelever) : 100),
      pcImmeublesTransfertFichiers: (int) ($dataSourceResult->NbImmeubles > 0  ? round((100 * $dataSourceResult->NbImmeublesTransfertFichiers) / $dataSourceResult->NbImmeubles) : 100)
    );
  }

}
