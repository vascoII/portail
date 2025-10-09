<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;


interface OperatorDataSourceInterface
{

    public function fetchGetOperators(ListOperatorsInputDto $inputDto): object;
    public function fetchPostOperator(CreateOperatorInputDto $inputDto): bool;
    public function fetchGetOperator(GetByIdIntInputDto $inputDto): object;
    public function fetchPutOperator(PutOperatorInputDto $inputDto): object;
    public function fetchPatchOperator(PatchOperatorInputDto $inputDto): object;
    public function fetchDeleteOperator(GetByIdIntInputDto $inputDto): object;
}
