<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;

interface OperatorDataSourceInterface
{

    public function fetchGetOperators(ListOperatorsInputDto $inputDto): object;
  
}
