<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetDetailsDepannageInpuDto;
use App\Application\Dto\Input\Shared\GetExcelInpuDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Input\Shared\GetReportByTokenInputDto;

interface SharedDataSourceInterface
{

  public function fetchGetDetailsDepannage(GetDetailsDepannageInpuDto $inputDto): object;
  public function fetchGetExcel(GetExcelInpuDto $inputDto): object;
  public function fetchGetReport(GetReportInputDto $inputDto): object;
  public function fetchGetReportByToken(GetReportByTokenInputDto $inputDto): object;
}
