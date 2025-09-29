<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Intervention\ReportInputDto;

interface InterventionDataSourceInterface
{

  public function fetchReport(ReportInputDto $inputDto): object;
}
