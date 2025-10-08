<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
interface OperatorDataProviderInterface
{

  public function listOperators(ListOperatorsInputDto $inputDto): ListOperatorsOutputDto;
  public function createOperatorService(CreateOperatorInputDto $inputDto): SuccessOutputDto;

}
