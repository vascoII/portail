<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

interface DocumentDataSourceInterface
{
  public function fetchInsertPrintJobs(string $reportType, array $paramsFiltres): object;
}
