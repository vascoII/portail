<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;

interface OperatorDataProviderInterface
{

  public function listOperators(ListOperatorsInputDto $inputDto): ListOperatorsOutputDto;

}
