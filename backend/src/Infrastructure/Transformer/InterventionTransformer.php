<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Intervention\ReportOutputDto;

final class InterventionTransformer
{
   /**
   * Transform raw SOAP response to ReportInputDto
   */
   public function transformReportResponse(array $response): ReportOutputDto
   {
      return new ReportOutputDto();
   }

}