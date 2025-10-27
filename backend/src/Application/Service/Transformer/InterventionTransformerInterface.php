<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Intervention\ListCasesOutputDto;

interface InterventionTransformerInterface
{
   /**
    * Transform raw response to ListCasesOutputDto
    */
   public function transformGetCases(object $dataSourceResult): ListCasesOutputDto;
  
}
