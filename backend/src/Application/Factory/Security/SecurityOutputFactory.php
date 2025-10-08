<?php

declare(strict_types=1);

namespace App\Application\Factory\Security;

use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Shared\SessionDto;
use App\Application\Dto\Output\Shared\UserDto;
use App\Domain\Entity\User;
use App\Domain\Entity\Session;

final class SecurityOutputFactory {

    public function createSessionDto(Session $session): SessionDto
    {
        return new SessionDto(session: $session);
    }

    public function createLoginOutputDto(SessionDto $sessionDto, string $tokenJwt): LoginOutputDto
    {
        return new LoginOutputDto(
            tokenJwt: $tokenJwt,
            loginId: $sessionDto->session->user->loginId,
            userName: $sessionDto->session->user->userName,
            email: $sessionDto->session->user->email,
            userType: $sessionDto->session->user->userType,
            adresse: $sessionDto->session->user->adresse,
            cp: $sessionDto->session->user->cp,
            ville: $sessionDto->session->user->ville,
            phoneNumber: $sessionDto->session->user->phoneNumber,
            firstName: $sessionDto->session->user->firstName,
            userRole: $sessionDto->session->user->userRole,
            clientName: $sessionDto->session->user->clientName,
            nbImmeubles: $sessionDto->session->user->nbImmeubles,
            seuilConsoEf: $sessionDto->session->user->seuilConsoEf,
            seuilConsoEc: $sessionDto->session->user->seuilConsoEc,
            seuilConsoRepart: $sessionDto->session->user->seuilConsoRepart,
            seuilConsoCet: $sessionDto->session->user->seuilConsoCet,
            seuilConsoActif: $sessionDto->session->user->seuilConsoActif,
            seuilConsoEmail: $sessionDto->session->user->seuilConsoEmail,
            showImmeublesArc: $sessionDto->session->user->showImmeublesArc,
            showFactures: $sessionDto->session->user->showFactures,
            showChgtOccupant: $sessionDto->session->user->showChgtOccupant,
            showChantiers: $sessionDto->session->user->showChantiers
        );
    }

    public function arrayToSessionDto(array $sessionData): SessionDto
    {
        $userData = $sessionData['user'] ?? null;

        $user = $userData ? new User(
            loginId: $userData['loginId'] ?? null,
            userName: $userData['userName'] ?? null,
            password: $userData['password'] ?? null,
            email: $userData['email'] ?? null,
            userType: $userData['userType'] ?? null,
            pkUser: $userData['pkUser'] ?? null,
            adresse: $userData['adresse'] ?? null,
            cp: $userData['cp'] ?? null,
            ville: $userData['ville'] ?? null,
            fk: $userData['fk'] ?? null,
            phoneNumber: $userData['phoneNumber'] ?? null,
            firstName: $userData['firstName'] ?? null,
            userRole: $userData['userRole'] ?? null,
            clientName: $userData['clientName'] ?? null,
            clientId: $userData['clientId'] ?? null,
            expirationDate: isset($userData['expirationDate']) ? new \DateTimeImmutable($userData['expirationDate']) : null,
            passwordExpirationDate: isset($userData['passwordExpirationDate']) ? new \DateTimeImmutable($userData['passwordExpirationDate']) : null,
            cgu: $userData['cgu'] ?? null,
            fkClient: $userData['fkClient'] ?? null,
            fkClientTop: $userData['fkClientTop'] ?? null,
            nbImmeubles: $userData['nbImmeubles'] ?? null,
            seuilConsoEf: $userData['seuilConsoEf'] ?? null,
            seuilConsoEc: $userData['seuilConsoEc'] ?? null,
            seuilConsoRepart: $userData['seuilConsoRepart'] ?? null,
            seuilConsoCet: $userData['seuilConsoCet'] ?? null,
            seuilConsoActif: $userData['seuilConsoActif'] ?? null,
            seuilConsoEmail: $userData['seuilConsoEmail'] ?? null,
            showImmeublesArc: $userData['showImmeublesArc'] ?? null,
            showFactures: $userData['showFactures'] ?? null,
            showChgtOccupant: $userData['showChgtOccupant'] ?? null,
            showChantiers: $userData['showChantiers'] ?? null
        ) : null;

        $session = new Session(
            connected: $sessionData['connected'] ?? null,
            sessionId: $sessionData['sessionId'] ?? null,
            user: $user
        );

        return new SessionDto($session);
    }

    public function createUserDto(User $user): UserDto
    {
        return new UserDto(
            loginId: $user->loginId,
            userName: $user->userName,
            email: $user->email,
            userType: $user->userType,
            pkUser: $user->pkUser,
            adresse: $user->adresse,
            cp: $user->cp,
            ville: $user->ville,
            fk: $user->fk,
            phoneNumber: $user->phoneNumber,
            firstName: $user->firstName,
            userRole: $user->userRole,
            clientName: $user->clientName,
            clientId: $user->clientId,
            cgu: $user->cgu,
            fkClient: $user->fkClient,
            fkClientTop: $user->fkClientTop,
            nbImmeubles: $user->nbImmeubles,
            seuilConsoEf: $user->seuilConsoEf,
            seuilConsoEc: $user->seuilConsoEc,
            seuilConsoRepart: $user->seuilConsoRepart,
            seuilConsoCet: $user->seuilConsoCet,
            seuilConsoActif: $user->seuilConsoActif,
            seuilConsoEmail: $user->seuilConsoEmail,
            showImmeublesArc: $user->showImmeublesArc,
            showFactures: $user->showFactures,
            showChgtOccupant: $user->showChgtOccupant,
            showChantiers: $user->showChantiers
        );
    }
}
