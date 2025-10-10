<?php

declare(strict_types=1);

namespace App\Application\Factory\Immeuble;

use App\Domain\Entity\Immeuble;
use App\Domain\Entity\Anomalie;
use App\Domain\Entity\Fuite;
use App\Domain\Entity\Dysfonctionnement;
use App\Domain\Entity\Depannage;


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
            hasChantiers: $raw->Immeuble->HasChantiers  
        );
    }

    public function createAnomalieFromRaw(object $raw): Anomalie
    {
        return new Anomalie(
            index: $raw->Index,
            conso: $raw->Conso,
            observations: $raw->observations  
        );
    }

    public function createFuiteFromRaw(object $raw): Fuite
    {
        return new Fuite(
            duree: $raw->Duree,
            dateDebut:new \DateTimeImmutable($raw->DateDebut),
            indexDebut: $raw->IndexDebut,
            conso: $raw->Conso 
        );
    }

    public function createDysfonctionnementFromRaw(object $raw): Dysfonctionnement
    {
        return new Dysfonctionnement(
            duree: $raw->Duree,
            dateDebut: new \DateTimeImmutable($raw->DateDebut),
            indexDebut: $raw->IndexDebut,
            conso: $raw->Conso,
            type: $raw->Type  
        );
    }

    public function createInterventionFromRaw(object $raw): Depannage
    {
        return new Depannage(
            workOrderNumber: $raw->Depannage->WorkOrderNumber,
            numero: $raw->Depannage->Numero,
            statut: $raw->Depannage->Statut,
            statutAbrege: $raw->Depannage->StatutAbrege,
            date: new \DateTimeImmutable($raw->Depannage->Date),
            motif: $raw->Depannage->Motif,
            motifAbrege: $raw->Depannage->MotifAbrege,
            compteRendu: $raw->Depannage->CompteRendu
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

    /**
     * @param object[] $rawList
     * @return Anomalie[]
     */
    public function createManyAnomaliesFromRawList(array $rawList): array
    {
        return array_map([$this, 'createAnomalieFromRaw'], $rawList);
    }

    /**
     * @param object[] $rawList
     * @return Fuite[]
     */
    public function createManyFuitesFromRawList(array $rawList): array
    {
        return array_map([$this, 'createFuiteFromRaw'], $rawList);
    }

    /**
     * @param object[] $rawList
     * @return Dysfonctionnement[]
     */
    public function createManyDysfonctionnementsFromRawList(array $rawList): array
    {
        return array_map([$this, 'createDysfonctionnementFromRaw'], $rawList);
    }

    /**
     * @param object[] $rawList
     * @return Intervention[]
     */
    public function createManyInterventionsFromRawList(array $rawList): array
    {
        return array_map([$this, 'createInterventionFromRaw'], $rawList);
    }
}
