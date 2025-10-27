<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

final class DocumentHydrator
{
  public function hydrateInsertPrintJobs(string $reportType, array $paramsFiltres): object
  {
    // Serialize params array to string format for SOAP
    $paramsFiltresString = json_encode($paramsFiltres);

    return (object) [
      'ReportType' => $reportType,
      'ParamsFiltres' => $paramsFiltresString,
    ];
  }
}
