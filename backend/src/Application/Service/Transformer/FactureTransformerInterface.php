<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Facture\GetFacturesOutputDto;

interface FactureTransformerInterface
{
  /**
   * Transform raw response to IndexOutputDto
   */
  public function transformIndex(object $dataSourceResult): GetFacturesOutputDto;
  

  /**
   * Transform raw response to ReportOutputDto
   */
  public function transformReport(string $dataSourceResult): GetReportOutputDto;
  
}
