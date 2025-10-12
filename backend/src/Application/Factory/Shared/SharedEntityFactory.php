<?php

declare(strict_types=1);

namespace App\Application\Factory\Shared;

use App\Domain\Entity\User;
use App\Domain\Entity\Session;
use App\Domain\Entity\Fuite;
use App\Domain\Entity\Dysfonctionnement;
use App\Domain\Entity\Depannage;
use App\Domain\Entity\Anomalie;

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

    public function createFuiteFromRaw(object $raw): Fuite
    {
        return new Fuite(
            duree: $raw->Duree,
            dateDebut: new \DateTimeImmutable($raw->DateDebut),
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

    public function createAnomalieFromRaw(object $raw): Anomalie
    {
        return new Anomalie(
            index: $raw->Index,
            conso: $raw->Conso,
            observations: $raw->observations
        );
    }

    public function createAlerteFromRaw(object $raw): Alerte
    {
        return new Alerte(
            index: $raw->Index,
            conso: $raw->Conso,
            observations: $raw->observations
        );
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
