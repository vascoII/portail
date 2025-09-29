<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Facture\ReportInputDto;

interface FactureDataSourceInterface
{
  public function fetchIndex(): object;
  public function fetchReport(ReportInputDto $inputDto): object;
}
