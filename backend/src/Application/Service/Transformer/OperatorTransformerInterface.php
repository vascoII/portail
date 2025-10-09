<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Dto\Output\Operator\GetOperatorOutputDto;

interface OperatorTransformerInterface
{
   public function transformListOperators(object $dataSourceResult): ListOperatorsOutputDto;
   public function transformGetOperator(object $dataSourceResult): GetOperatorOutputDto;
   
}
