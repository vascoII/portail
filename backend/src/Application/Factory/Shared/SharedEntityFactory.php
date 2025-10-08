<?php

declare(strict_types=1);

namespace App\Application\Factory\Shared;

use App\Domain\Entity\User;
use App\Domain\Entity\Session;

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
}
