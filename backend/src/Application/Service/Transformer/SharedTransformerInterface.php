<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Shared\GetExcelOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Dto\Output\Shared\UserDto;

interface SharedTransformerInterface
{
  /**
   * Transform raw response to SuccessOutputDto
   */
  public function transformPost(bool $dataSourceResult): SuccessOutputDto;
  public function transformPut(object $dataSourceResult): SuccessOutputDto;
  public function transformPatch(object $dataSourceResult): SuccessOutputDto;
  public function transformDelete(object $dataSourceResult): SuccessOutputDto;

  public function transformGetUser(object $dataSourceResult): UserDto;

  /**
   * Transform raw response to GetExcelOutputDto
   */
  public function transformGetExcel(object $dataSourceResult): GetExcelOutputDto;


  /**
   * Transform raw response to GetReportOutputDto
   */
  public function transformGetReport(string $dataSourceResult, string $filename): GetReportOutputDto;

  public function transformSuccess(): SuccessOutputDto;
}
