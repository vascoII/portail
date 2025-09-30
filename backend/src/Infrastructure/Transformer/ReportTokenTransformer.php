<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\ReportToken\LoadingOutputDto;
use App\Application\Dto\Output\ReportToken\ReportOutputDto;

final class ReportTokenTransformer
{
   /**
    * Transform raw response to LoadingOutputDto
    */
   public function transformLoading(object $dataSourceResult): LoadingOutputDto
   {
      return new LoadingOutputDto();
   }

   /**
    * Transform raw response to ReportInputDto
    */
   public function transformReport(object $dataSourceResult): ReportOutputDto
   {
      return new ReportOutputDto();
   }
}
