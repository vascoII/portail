<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Dto\Output\Operator\GetOperatorOutputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;

interface OperatorTransformerInterface
{
   public function transformListOperators(object $dataSourceResult): ListOperatorsOutputDto;
   public function transformGetOperator(object $dataSourceResult): GetOperatorOutputDto;
   public function transformGetOperatorStat(object $dataSourceResult): SuccessOutputDto;
   public function transformCreateOperationImmeuble(object $dataSourceResult): SuccessOutputDto;
   public function transformPatchOperatorImmeuble(object $dataSourceResult): SuccessOutputDto;
}
