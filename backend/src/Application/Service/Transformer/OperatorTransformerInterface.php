<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;

interface OperatorTransformerInterface
{
   public function transformListOperators(object $dataSourceResult): ListOperatorsOutputDto;
   
}
