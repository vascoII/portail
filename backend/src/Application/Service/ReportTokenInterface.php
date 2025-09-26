<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\Input\ReportToken\LoadingInputDto;
use App\Application\Dto\Output\ReportToken\LoadingOutputDto;
use App\Application\Dto\Input\ReportToken\ReportInputDto;
use App\Application\Dto\Output\ReportToken\ReportOutputDto;

interface ReportTokenInterface
{

  public function loadingService(LoadingInputDto $inputDto): LoadingOutputDto;
  public function reportService(ReportInputDto $inputDto): ReportOutputDto;
}
