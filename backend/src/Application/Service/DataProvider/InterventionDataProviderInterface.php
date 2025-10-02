<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;

interface InterventionDataProviderInterface
{

  public function reportService(GetReportInputDto $inputDto): GetReportOutputDto;
}
