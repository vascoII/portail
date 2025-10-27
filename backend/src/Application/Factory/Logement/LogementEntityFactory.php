<?php

declare(strict_types=1);

namespace App\Application\Factory\Logement;

use App\Domain\Entity\Logement;
use App\Domain\Entity\Occupant;

final class LogementEntityFactory 
{
    public function createLogementFromRaw(object $raw): array
    {
        return [
            'logement' => new Logement(
                pkLogement: $raw->Logement->PkLogement,
                numBatiment: $raw->Logement->NumBatiment,
                adrBatiment: $raw->Logement->AdrBatiment,
                numEscalier: $raw->Logement->NumEscalier,
                adrEscalier: $raw->Logement->AdrEscalier,
                numEtage: $raw->Logement->NumEtage,
                numOrdre: $raw->Logement->NumOrdre,
                type: $raw->Logement->Type
            ),
            'occupant' => new Occupant(
                pkOccupant: $raw->Occupant->PkOccupant,
                nom: $raw->Occupant->Nom,
                ref: $raw->Occupant->Ref,
                dateArrivee: new \DateTimeImmutable($raw->Occupant->DateArrivee),
                dateDepart: new \DateTimeImmutable($raw->Occupant->DateDepart)
            ),
            'nbAppareils' => $raw->NbAppareils,
            'nbCompteursEC' => $raw->NbCompteursEC,
            'nbCompteursEF' => $raw->NbCompteursEF,
            'nbCompteursRepart' => $raw->NbCompteursRepart,
            'nbCompteursCET' => $raw->NbCompteursCET,
            'nbCompteursCapteur' => $raw->NbCompteursCapteur,
            'nbCompteursElect' => $raw->NbCompteursElect,
            'nbCompteursGaz' => $raw->NbCompteursGaz,
            'nbFuites' => $raw->NbFuites ?? null,
            'nbDepannages' => $raw->NbDepannages,
            'nbDysfonctionnements' => $raw->NbDysfonctionnements,
            'nbAnomalies' => $raw->NbAnomalies ?? null,
            'nbTicketsInter' => $raw->NbTicketsInter,
            'ticketsInterEnabled' => $raw->TicketsInterEnabled,
            'listeAppareils' => $raw->ListeAppareils ?? null
        ];
    }
    /**
     * @param object[] $rawList
     * @return Logement[]
     */
    public function createManyLogementsFromRawList(array $rawList): array
    {
        return array_map([$this, 'createLogementFromRaw'], $rawList);
    }
}
