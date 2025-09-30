<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Intervention\ReportOutputDto;

final class InterventionTransformer
{
   /**
    * Transform raw response to ReportInputDto
    */
   public function transformReport(object $dataSourceResult): ReportOutputDto
   {
      return new ReportOutputDto();
   }
}
