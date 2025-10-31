<?php

declare(strict_types=1);

namespace App\Application\Factory\Parc;

use App\Application\Dto\Output\Parc\GetParcOutputDto;
use App\Domain\Entity\TableauDeBordClient;

final class GetParcOutputFactory
{
    public function createGetOperator(TableauDeBordClient $tableauDeBordClient): GetParcOutputDto
    {
        return new GetParcOutputDto(
            nbImmeubles: $tableauDeBordClient->nbImmeubles,
            nbImmeublesTelereleve: $tableauDeBordClient->nbImmeublesTelereleve,
            nbImmeublesTransfertFichiers: $tableauDeBordClient->nbImmeublesTransfertFichiers,
            nbCompteursARelever: $tableauDeBordClient->nbCompteursARelever,
            nbCompteursReleves: $tableauDeBordClient->nbCompteursReleves,
            nbLogements: $tableauDeBordClient->nbLogements,
            nbCompteurs: $tableauDeBordClient->nbCompteurs,
            nbCompteursEc: $tableauDeBordClient->nbCompteursEc,
            nbCompteursEf: $tableauDeBordClient->nbCompteursEf,
            nbCompteursRepart: $tableauDeBordClient->nbCompteursRepart,
            nbCompteursCet: $tableauDeBordClient->nbCompteursCet,
            nbCompteursCapteur: $tableauDeBordClient->nbCompteursCapteur,
            nbCompteursElect: $tableauDeBordClient->nbCompteursElect,
            nbCompteursGaz: $tableauDeBordClient->nbCompteursGaz,
            nbFuites: $tableauDeBordClient->nbFuites,
            degresFuites: $tableauDeBordClient->degresFuites,
            nbDepannages: $tableauDeBordClient->nbDepannages,
            degresDepannages: $tableauDeBordClient->degresDepannages,
            nbDysfonctionnements: $tableauDeBordClient->nbDysfonctionnements,
            degresDysfonctionnements: $tableauDeBordClient->degresDysfonctionnements,
            nbAnomalies: $tableauDeBordClient->nbAnomalies,
            degresAnomalies: $tableauDeBordClient->degresAnomalies,
            nbChantiers: $tableauDeBordClient->nbChantiers,
            nbCompteursPoses: $tableauDeBordClient->nbCompteursPoses,
            nbCompteursCommandes: $tableauDeBordClient->nbCompteursCommandes,
            pcImmeublesTelereleve: (int) ($tableauDeBordClient->nbCompteursARelever > 0 ? round((100 * $tableauDeBordClient->nbCompteursReleves) / $tableauDeBordClient->nbCompteursARelever) : 100),
            pcImmeublesTransfertFichiers: (int) ($tableauDeBordClient->nbImmeubles > 0 ? round((100 * $tableauDeBordClient->nbImmeublesTransfertFichiers) / $tableauDeBordClient->nbImmeubles) : 100)
        );
    }
}
