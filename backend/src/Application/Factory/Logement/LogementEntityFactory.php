<?php

declare(strict_types=1);

namespace App\Application\Factory\Logement;

use App\Domain\Entity\Immeuble;
use App\Domain\Entity\Logement;
use App\Domain\Entity\Occupant;

final class LogementEntityFactory
{
    public function createLogementFromRaw(object $raw): array
    {
        return [
            'immeuble' => new Immeuble(
                pkImmeuble: $raw->Immeuble->PkImmeuble,
                nom: $raw->Immeuble->Nom,
                numero: $raw->Immeuble->Numero,
                ref: $raw->Immeuble->Ref,
                adresse1: $raw->Immeuble->Adresse1,
                adresse2: $raw->Immeuble->Adresse2,
                adresse3: $raw->Immeuble->Adresse3,
                cp: $raw->Immeuble->Cp,
                ville: $raw->Immeuble->Ville,
                hasTelereleve: $raw->Immeuble->HasTelereleve,
                fkClientTop: $raw->Immeuble->FkClientTop,
                actif: $raw->Immeuble->Actif,
                dateActivationClient: new \DateTimeImmutable($raw->Immeuble->DateActivationClient),
                dateActivationOccupant: new \DateTimeImmutable($raw->Immeuble->DateActivationOccupant),
                hasNoteOccupant: $raw->Immeuble->HasNoteOccupant,
                hasDecompteOccupant: $raw->Immeuble->HasDecompteOccupant,
                hasFactures: $raw->Immeuble->HasFactures,
                hasChantiers: $raw->Immeuble->HasChantiers,
                nbLogements: null,
                nbAppareils: null,
                nbDepannages: null,
                nbDepannagesTotal: null,
                degresDepannages: null,
                nbDysfonctionnements: null,
                degresDysfonctionnements: null,
                nbCompteursEC: null,
                nbCompteursEF: null,
                nbCompteursRepart: null,
                nbCompteursCET: null,
                nbCompteursCapteur: null,
                nbCompteursElect: null,
                nbCompteursGaz: null,
                nbCompteursTelereveleTotal: null,
                nbCompteursTelereveleOK: null,
                hasTransfertFichiers: null,
                nbFuites: null,
                nbAnomalies: null,
                nbChantiers: null
            ),
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
            'listeAppareils' => $raw->ListeAppareils ?? null,
        ];
    }

    /**
     * @param object[] $rawList
     *
     * @return Logement[]
     */
    public function createManyLogementsFromRawList(array $rawList): array
    {
        return array_map([$this, 'createLogementFromRaw'], $rawList);
    }
}
