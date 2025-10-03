<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Intervention\ReportOutputDto;

interface InterventionTransformerInterface
{
   /**
    * Transform raw response to ReportInputDto
    */
   public function transformReport(object $dataSourceResult): ReportOutputDto;
  
}
