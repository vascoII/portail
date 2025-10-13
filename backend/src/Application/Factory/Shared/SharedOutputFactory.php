<?php

declare(strict_types=1);

namespace App\Application\Factory\Shared;

use App\Application\Dto\Output\Shared\UserDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;
use App\Domain\Entity\User;

final class SharedOutputFactory 
{
    /**
     * @param User $operator
     */
    public function createUser(User $operator): UserDto
    {
        return new UserDto(
            loginId: $operator->loginId,
            userName: $operator->userName,
            email: $operator->email,
            userType: $operator->userType,
            pkUser: $operator->pkUser,
            adresse: $operator->adresse,
            cp: $operator->cp,
            ville: $operator->ville,
            fk: $operator->fk,
            phoneNumber: $operator->phoneNumber,
            firstName: $operator->firstName,
            userRole: $operator->userRole,
            clientName: $operator->clientName,
            clientId: $operator->clientId,
            cgu: $operator->cgu,
            fkClient: $operator->fkClient,
            fkClientTop: $operator->fkClientTop,
            nbImmeubles: $operator->nbImmeubles,
            seuilConsoEf: $operator->seuilConsoEf,
            seuilConsoEc: $operator->seuilConsoEc,
            seuilConsoRepart: $operator->seuilConsoRepart,
            seuilConsoCet: $operator->seuilConsoCet,
            seuilConsoActif: $operator->seuilConsoActif,
            seuilConsoEmail: $operator->seuilConsoEmail,
            showImmeublesArc: $operator->showImmeublesArc,
            showFactures: $operator->showFactures,
            showChgtOccupant: $operator->showChgtOccupant,
            showChantiers: $operator->showChantiers
        );
    }

    public function createListImmeublesIndicators(array $listIndicators): ListIndicatorsOuputDto
    {
        return new ListIndicatorsOuputDto($listIndicators);
    }

    public function createListLogementsIndicators(array $listIndicators): ListIndicatorsOuputDto
    {
        return new ListIndicatorsOuputDto($listIndicators);
    }
}
