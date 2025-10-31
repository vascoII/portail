<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Operator\CreateOperationImmeubleInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorImmeubleInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

interface OperatorDataSourceInterface
{
    public function fetchCreateOperationImmeuble(CreateOperationImmeubleInputDto $inputDto): object;

    public function fetchDeleteOperator(GetByIdIntInputDto $inputDto): object;

    public function fetchGetOperator(GetByIdIntInputDto $inputDto): object;

    public function fetchGetOperators(ListOperatorsInputDto $inputDto): object;

    public function fetchGetOperatorStat(GetByIdIntInputDto $inputDto): object;

    public function fetchPatchOperator(PatchOperatorInputDto $inputDto): object;

    public function fetchPatchOperatorImmeuble(PatchOperatorImmeubleInputDto $inputDto): object;

    public function fetchPostOperator(CreateOperatorInputDto $inputDto): bool;

    public function fetchPutOperator(PutOperatorInputDto $inputDto): object;
}
