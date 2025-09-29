<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Intervention\ReportInputDto;
use App\Application\Dto\Output\Intervention\ReportOutputDto;

interface InterventionDataProviderInterface
{

  public function reportService(ReportInputDto $inputDto): ReportOutputDto;
}
