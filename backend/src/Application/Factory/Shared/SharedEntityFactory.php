<?php

declare(strict_types=1);

namespace App\Application\Factory\Shared;

use App\Domain\Entity\User;
use App\Domain\Entity\Session;
use App\Domain\Entity\Fuite;
use App\Domain\Entity\Dysfonctionnement;
use App\Domain\Entity\Depannage;
use App\Domain\Entity\Anomalie;
use App\Domain\Entity\Logement;
use App\Domain\Entity\Occupant;
use App\Domain\Entity\Appareil;

final class SharedEntityFactory
{
    public function createUserFromRaw(object $raw): User
    {
        return new User(
            loginId: (string) $raw->LoginID,
            userName: (string) $raw->UserName,
            password: (string) $raw->Password,
            email: (string) $raw->EMail,
            userType: (string) $raw->UserType,
            pkUser: (int) $raw->PKUser,
            adresse: (string) $raw->Adresse,
            cp: (string) $raw->CP,
            ville: (string) $raw->Ville,
            fk: (int) $raw->FK,
            phoneNumber: (string) $raw->PhoneNumber,
            firstName: (string) $raw->FirstName,
            userRole: (string) $raw->UserRole,
            clientName: (string) $raw->ClientName,
            clientId: (string) $raw->ClientID,
            expirationDate: new \DateTimeImmutable($raw->ExpirationDate),
            passwordExpirationDate: new \DateTimeImmutable($raw->PasswordExpirationDate),
            cgu: (string) $raw->CGU,
            fkClient: (int) $raw->FKClient,
            fkClientTop: (int) $raw->FKClientTop,
            nbImmeubles: (int) $raw->NbImmeubles,
            seuilConsoEf: (int) $raw->Seuil_Conso_EF,
            seuilConsoEc: (int) $raw->Seuil_Conso_EC,
            seuilConsoRepart: (int) $raw->Seuil_Conso_Repart,
            seuilConsoCet: (int) $raw->Seuil_Conso_CET,
            seuilConsoActif: (bool) $raw->Seuil_Conso_Actif,
            seuilConsoEmail: (string) $raw->Seuil_Conso_Email,
            showImmeublesArc: (bool) $raw->showImmeublesArc,
            showFactures: (bool) $raw->showFactures,
            showChgtOccupant: (bool) $raw->showChgtOccupant,
            showChantiers: (bool) $raw->showChantiers
        );
    }

    public function createSessionFromRaw(bool $isConnected, string $SessionIdRaw, User $user)
    {
        return new Session(
            connected: $isConnected,
            sessionId: $SessionIdRaw,
            user: $user
        );
    }

    /**
     * @param object[] $rawList
     * @return User[]
     */
    public function createManyUsersFromRawList(array $rawList): array
    {
        return array_map([$this, 'createUserFromRaw'], $rawList);
    }

    public function createFuiteFromRaw(object $raw): array
    {
        return [
            new Logement(
                pkLogement: $raw->Logement->PkLogement,
                numBatiment: $raw->Logement->NumBatiment,
                adrBatiment: $raw->Logement->AdrBatiment,
                numEscalier: $raw->Logement->NumEscalier,
                adrEscalier: $raw->Logement->AdrEscalier,
                numEtage: $raw->Logement->NumEtage,
                numOrdre: $raw->Logement->NumOrdre,
                type:  $raw->Logement->Type
            ), 
            new Occupant(
                pkOccupant: $raw->Occupant->PkOccupant,
                nom: $raw->Occupant->Nom,
                ref: $raw->Occupant->Ref,
                dateArrivee: new \DateTimeImmutable($raw->Occupant->DateArrivee),
                dateDepart: new \DateTimeImmutable($raw->Occupant->DateDepart),
            ), 
            new Appareil(
                pkAppareil: $raw->Appareil->PkAppareil,
                numero: $raw->Appareil->Numero,
                emplacement: $raw->Appareil->Emplacement,
                fluide: $raw->Appareil->Fluide,
                typeAppareil: $raw->Appareil->TypeAppareil,
                unite: $raw->Appareil->Unite,
            ), 
            new Fuite(
                duree: $raw->Fuite->Duree,
                dateDebut: new \DateTimeImmutable($raw->Fuite->DateDebut),
                indexDebut: $raw->Fuite->IndexDebut,
                conso: $raw->Fuite->Conso
            )
        ];
    }

    public function createDysfonctionnementFromRaw(object $raw): array
    {
        return [
            new Logement(
                pkLogement: $raw->Logement->PkLogement,
                numBatiment: $raw->Logement->NumBatiment,
                adrBatiment: $raw->Logement->AdrBatiment,
                numEscalier: $raw->Logement->NumEscalier,
                adrEscalier: $raw->Logement->AdrEscalier,
                numEtage: $raw->Logement->NumEtage,
                numOrdre: $raw->Logement->NumOrdre,
                type:  $raw->Logement->Type
            ), 
            new Occupant(
                pkOccupant: $raw->Occupant->PkOccupant,
                nom: $raw->Occupant->Nom,
                ref: $raw->Occupant->Ref,
                dateArrivee: new \DateTimeImmutable($raw->Occupant->DateArrivee),
                dateDepart: new \DateTimeImmutable($raw->Occupant->DateDepart),
            ), 
            new Appareil(
                pkAppareil: $raw->Appareil->PkAppareil,
                numero: $raw->Appareil->Numero,
                emplacement: $raw->Appareil->Emplacement,
                fluide: $raw->Appareil->Fluide,
                typeAppareil: $raw->Appareil->TypeAppareil,
                unite: $raw->Appareil->Unite,
            ), 
            new Dysfonctionnement(
                duree: $raw->Dysfonctionnement->Duree,
                dateDebut: new \DateTimeImmutable($raw->Dysfonctionnement->DateDebut),
                indexDebut: $raw->Dysfonctionnement->IndexDebut,
                conso: $raw->Dysfonctionnement->Conso,
                type: $raw->Dysfonctionnement->Type
            )
        ];
    }

    public function createInterventionFromRaw(object $raw): array
    {
        return [
            new Logement(
                pkLogement: $raw->Logement->PkLogement,
                numBatiment: $raw->Logement->NumBatiment,
                adrBatiment: $raw->Logement->AdrBatiment,
                numEscalier: $raw->Logement->NumEscalier,
                adrEscalier: $raw->Logement->AdrEscalier ?? null,
                numEtage: $raw->Logement->NumEtage,
                numOrdre: $raw->Logement->NumOrdre,
                type:  $raw->Logement->Type ?? null
            ), 
            new Occupant(
                pkOccupant: $raw->Occupant->PkOccupant,
                nom: $raw->Occupant->Nom,
                ref: $raw->Occupant->Ref ?? null,
                dateArrivee: new \DateTimeImmutable($raw->Occupant->DateArrivee),
                dateDepart: new \DateTimeImmutable($raw->Occupant->DateDepart),
            ), 
            new Depannage(
                workOrderNumber: $raw->Depannage->WorkOrderNumber,
                numero: $raw->Depannage->Numero,
                statut: $raw->Depannage->Statut,
                statutAbrege: $raw->Depannage->StatutAbrege,
                date: new \DateTimeImmutable($raw->Depannage->Date),
                motif: $raw->Depannage->Motif,
                motifAbrege: $raw->Depannage->MotifAbrege,
                compteRendu: $raw->Depannage->CompteRendu
            )
        ];
    }

    /**
     * Undocumented function
     *
     * @param object $raw
     * @return array
     */
    public function createAnomalieFromRaw(object $raw): array
    {   
        return [
            new Logement(
                pkLogement: $raw->Logement->PkLogement,
                numBatiment: $raw->Logement->NumBatiment,
                adrBatiment: $raw->Logement->AdrBatiment,
                numEscalier: $raw->Logement->NumEscalier,
                adrEscalier: $raw->Logement->AdrEscalier,
                numEtage: $raw->Logement->NumEtage,
                numOrdre: $raw->Logement->NumOrdre,
                type:  $raw->Logement->Type
            ), 
            new Occupant(
                pkOccupant: $raw->Occupant->PkOccupant,
                nom: $raw->Occupant->Nom,
                ref: $raw->Occupant->Ref,
                dateArrivee: new \DateTimeImmutable($raw->Occupant->DateArrivee),
                dateDepart: new \DateTimeImmutable($raw->Occupant->DateDepart),
            ), 
            new Appareil(
                pkAppareil: $raw->Appareil->PkAppareil,
                numero: $raw->Appareil->Numero,
                emplacement: $raw->Appareil->Emplacement,
                fluide: $raw->Appareil->Fluide,
                typeAppareil: $raw->Appareil->TypeAppareil,
                unite: $raw->Appareil->Unite,
            ), 
            new Anomalie(
                index: (float) $raw->Anomalie->Index,
                conso: (float) $raw->Anomalie->Conso,
                observations: $raw->Anomalie->Observations
            )
        ];
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

    /**
     * @param object[] $rawList
     * @return Alertes[]
     */
    public function createManyAlertesFromRawList(array $rawList): array
    {
        return array_map([$this, 'createAlerteFromRaw'], $rawList);
    }
}
