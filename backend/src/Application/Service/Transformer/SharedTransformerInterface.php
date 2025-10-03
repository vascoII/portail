<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Shared\GetDetailsDepannageOutputDto;
use App\Application\Dto\Output\Shared\GetExcelOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Shared\GetReportByTokenOutputDto;

interface SharedTransformerInterface
{
  /**
   * Transform raw response to GetDetailsDepannageOutputDto
   */
  public function transformGetDetailsDepannage(object $dataSourceResult): GetDetailsDepannageOutputDto;
  

  /**
   * Transform raw response to GetExcelOutputDto
   */
  public function transformGetExcel(object $dataSourceResult): GetExcelOutputDto;
  

  /**
   * Transform raw response to GetReportOutputDto
   */
  public function transformGetReport(object $dataSourceResult): GetReportOutputDto;
  

  /**
   * Transform raw response to GetReportByTokenOutputDto
   */
  public function transformGetReportByToken(object $dataSourceResult): GetReportByTokenOutputDto;
 
}
