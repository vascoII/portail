<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Operator\GetOperatorOutputDto;

interface OperatorDataProviderInterface
{

  public function listOperatorsService(ListOperatorsInputDto $inputDto): ListOperatorsOutputDto;
  public function createOperatorService(CreateOperatorInputDto $inputDto): SuccessOutputDto;
  public function getOperatorService(GetByIdIntInputDto $inputDto): GetOperatorOutputDto;
  public function putOperatorService(PutOperatorInputDto $inputDto): SuccessOutputDto;

}
