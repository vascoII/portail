<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Operator\CreateOperationImmeubleInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorImmeubleInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

final class OperatorHydrator extends Hydrator
{
    public function hydrateCreateOperationImmeuble(CreateOperationImmeubleInputDto $inputDto): object
    {
        return (object) [
            'PkUserChild' => $inputDto->operatorId,
            'PkImmeuble' => $inputDto->immeubleId,
        ];
    }

    public function hydrateDeleteOperator(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkUserChild' => $inputDto->id,
        ];
    }

    public function hydrateGetListOperators(ListOperatorsInputDto $inputDto): object
    {
        return (object) [
            'type' => $inputDto->type,
        ];
    }

    public function hydrateGetOperator(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkUserChild' => $inputDto->id,
        ];
    }

    public function hydrateGetOperatorStat(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'PkUserChild' => $inputDto->id,
        ];
    }

    public function hydratePatchOperator(PatchOperatorInputDto $inputDto): object
    {
        return (object) [
            'PkUserChild' => $inputDto->id,
            'Password' => $inputDto->password,
        ];
    }

    public function hydratePatchOperatorImmeuble(PatchOperatorImmeubleInputDto $inputDto): object
    {
        return (object) [
            'PkUserChild' => $inputDto->operatorId,
            'PkImmeuble' => $inputDto->immeubleId,
        ];
    }

    public function hydratePostOperator(CreateOperatorInputDto $inputDto): object
    {
        return (object) [
            'LoginID' => $inputDto->email,
            'UserName' => $inputDto->lastname,
            'FirstName' => $inputDto->firstname,
            'PhoneNumber' => $inputDto->phone,
            'Email' => $inputDto->email,
            'UserRole' => $inputDto->job,
        ];
    }

    public function hydratePutOperator(PutOperatorInputDto $inputDto): object
    {
        return (object) [
            'PkUserChild' => $inputDto->id,
            'LoginID' => $inputDto->email,
            'UserName' => $inputDto->lastname,
            'FirstName' => $inputDto->firstname,
            'PhoneNumber' => $inputDto->phone,
            'Email' => $inputDto->email,
            'UserRole' => $inputDto->job,
        ];
    }
}
