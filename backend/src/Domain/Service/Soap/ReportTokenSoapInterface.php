<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\ReportToken\LoadingInputDto;
use App\Application\Dto\Input\ReportToken\ReportInputDto;

interface ReportTokenSoapInterface
{

  public function loadingService(LoadingInputDto $inputDto): array;
  public function reportService(ReportInputDto $inputDto): array;
}
