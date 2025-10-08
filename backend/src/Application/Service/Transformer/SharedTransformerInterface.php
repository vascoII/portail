<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Shared\GetExcelOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
interface SharedTransformerInterface
{
  /**
   * Transform raw response to Post
   */
  public function transformPost(bool $dataSourceResult): SuccessOutputDto;
  

  /**
   * Transform raw response to GetExcelOutputDto
   */
  public function transformGetExcel(object $dataSourceResult): GetExcelOutputDto;
  

  /**
   * Transform raw response to GetReportOutputDto
   */
  public function transformGetReport(string $dataSourceResult, string $filename): GetReportOutputDto;
 
}
