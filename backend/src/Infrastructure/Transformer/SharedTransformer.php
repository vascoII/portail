<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Shared\GetDetailsDepannageOutputDto;
use App\Application\Dto\Output\Shared\GetExcelOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Shared\GetReportByTokenOutputDto;

final class SharedTransformer
{
  /**
   * Transform raw response to GetDetailsDepannageOutputDto
   */
  public function transformGetDetailsDepannage(object $dataSourceResult): GetDetailsDepannageOutputDto
  {
    $result = $dataSourceResult->GetDetailsDepannageResult;
    return new GetDetailsDepannageOutputDto($result);
  }

  /**
   * Transform raw response to GetExcelOutputDto
   */
  public function transformGetExcel(object $dataSourceResult): GetExcelOutputDto
  {
    $binary = (string) $dataSourceResult->GetExcelResult;
    $filename = 'export-' . date('Y-m-d') . '.xlsx';
    return new GetExcelOutputDto(
      data: $binary,
      filename: $filename,
      length: strlen($binary)
    );
  }

  /**
   * Transform raw response to GetReportOutputDto
   */
  public function transformGetReport(object $dataSourceResult): GetReportOutputDto
  {
    $binary = (string) $dataSourceResult->GetReportResult;
    $filename = 'report-' . date('Y-m-d') . '.pdf';
    return new GetReportOutputDto(
      data: $binary,
      filename: $filename,
      length: strlen($binary)
    );
  }

  /**
   * Transform raw response to GetReportByTokenOutputDto
   */
  public function transformGetReportByToken(object $dataSourceResult): GetReportByTokenOutputDto
  {
    $binary = (string) $dataSourceResult->GetReportByTokenResult;
    $filename = 'report-token-' . date('Y-m-d') . '.pdf';
    return new GetReportByTokenOutputDto(
      data: $binary,
      filename: $filename,
      length: strlen($binary)
    );
  }
}
