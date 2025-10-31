<?php

declare(strict_types=1);

namespace App\Application\Factory\Operator;

use App\Application\Dto\Output\Operator\GetOperatorOutputDto;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Domain\Entity\User;

final class OperatorOutputFactory
{
    public function createGetOperator(User $operator): GetOperatorOutputDto
    {
        return new GetOperatorOutputDto(
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

    /**
     * @param User[] $operators
     */
    public function createListOperators(array $operators): ListOperatorsOutputDto
    {
        return new ListOperatorsOutputDto($operators);
    }
}
