<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Dto\Output\Shared\GetExcelOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Service\Transformer\SharedTransformerInterface;
use App\Application\Factory\Shared\SharedEntityFactory;
use App\Application\Factory\Shared\SharedOutputFactory;


final class SharedTransformer implements SharedTransformerInterface
{
  public function __construct(
      private readonly SharedEntityFactory $entityFactory,
      private readonly SharedOutputFactory $outputFactory
   ) {}
   
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
   * Transform raw response to ReportOutputDto
   */
  public function transformGetReport(string $dataSourceResult, string $filename): GetReportOutputDto
  {
    return new GetReportOutputDto (
      data: $dataSourceResult,
      filename: $filename,
      length: strval(strlen($dataSourceResult))
    );
  }

  public function transformPost(bool $dataSourceResult): SuccessOutputDto
  {
       return new SuccessOutputDto (bool: $dataSourceResult);   
  }

}
