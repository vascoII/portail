<?php

declare(strict_types=1);

namespace App\Application\Factory\Parc;

use App\Domain\Entity\TableauDeBordClient;

final class GetParcEntityFactory
{
    public function createTableauDeBordClientFromRaw(object $raw): TableauDeBordClient
    {
        return new TableauDeBordClient(
            nbImmeubles: $raw->NbImmeubles,
            nbImmeublesTelereleve: $raw->NbImmeublesTelereleve,
            nbImmeublesTransfertFichiers: $raw->NbImmeublesTransfertFichiers,
            nbCompteursARelever: $raw->NbCompteursARelever,
            nbCompteursReleves: $raw->NbCompteursReleves,
            nbLogements: $raw->NbLogements,
            nbCompteurs: $raw->NbCompteurs,
            nbCompteursEc: $raw->NbCompteursEC,
            nbCompteursEf: $raw->NbCompteursEF,
            nbCompteursRepart: $raw->NbCompteursRepart,
            nbCompteursCet: $raw->NbCompteursCET,
            nbCompteursCapteur: $raw->NbCompteursCapteur,
            nbCompteursElect: $raw->NbCompteursElect,
            nbCompteursGaz: $raw->NbCompteursGaz,
            nbFuites: $raw->NbFuites,
            degresFuites: $raw->DegresFuites,
            nbDepannages: $raw->NbDepannages,
            degresDepannages: $raw->DegresDepannages,
            nbDysfonctionnements: $raw->NbDysfonctionnements,
            degresDysfonctionnements: $raw->DegresDysfonctionnements,
            nbAnomalies: $raw->NbAnomalies,
            degresAnomalies: $raw->DegresAnomalies,
            nbChantiers: $raw->NbChantiers,
            nbCompteursPoses: $raw->NbCompteursPoses,
            nbCompteursCommandes: $raw->NbCompteursCommandes
        );
    }
}
