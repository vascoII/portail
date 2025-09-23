<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\ReportToken\LoadingOutputDto;
use App\Application\Dto\Output\ReportToken\ReportOutputDto;

final class ReportTokenTransformer
{
   /**
   * Transform raw SOAP response to LoadingOutputDto
   */
   public function transformLoadingResponse(array $response): LoadingOutputDto
   {
      return new LoadingOutputDto();
   }

   /**
   * Transform raw SOAP response to ReportInputDto
   */
   public function transformReportResponse(array $response): ReportOutputDto
   {
      return new ReportOutputDto();
   }

}