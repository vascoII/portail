<?php

declare(strict_types=1);

namespace App\Application\Factory\Immeuble;

use App\Domain\Entity\Immeuble;



final class ImmeubleEntityFactory
{
    public function createImmeubleFromRaw(object $raw): Immeuble
    { 
        return new Immeuble(
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
            nbLogements: $raw->NbLogements,
            nbAppareils: $raw->NbAppareils,
            nbDepannages: $raw->NbDepannages,
            nbDepannagesTotal: $raw->NbDepannagesTotal ?? null,
            degresDepannages: $raw->DegresDepannages ?? null,
            nbDysfonctionnements: $raw->NbDysfonctionnements,
            degresDysfonctionnements: $raw->DegresDysfonctionnements ?? null,
            nbCompteursEC: $raw->NbCompteursEC,
            nbCompteursEF: $raw->NbCompteursEF,
            nbCompteursRepart: $raw->NbCompteursRepart,
            nbCompteursCET: $raw->NbCompteursCET,
            nbCompteursCapteur: $raw->NbCompteursCapteur,
            nbCompteursElect: $raw->NbCompteursElect,
            nbCompteursGaz: $raw->NbCompteursGaz,
            nbCompteursTelereveleTotal: $raw->NbCompteursTelereveleTotal ?? null,
            nbCompteursTelereveleOK: $raw->NbCompteursTelereveleOK ?? null,
            hasTransfertFichiers: $raw->HasTransfertFichiers ?? null,
            nbFuites: $raw->NbFuites ?? null,
            nbAnomalies: $raw->NbAnomalies ?? null,
            nbChantiers: $raw->NbChantiers ?? null

        );
    }

    /**
     * @param object[] $rawList
     * @return Immeuble[]
     */
    public function createManyImmeublesFromRawList(array $rawList): array
    {
        return array_map([$this, 'createImmeubleFromRaw'], $rawList);
    }
}
