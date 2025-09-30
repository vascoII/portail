<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\ReportToken\ReportInputDto;

interface ReportTokenDataSourceInterface
{

  public function fetchReport(ReportInputDto $inputDto): object;
}
