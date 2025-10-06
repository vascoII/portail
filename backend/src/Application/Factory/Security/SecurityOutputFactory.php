<?php

declare(strict_types=1);

namespace App\Application\Factory\Security;

use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\SessionDto;
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
}
