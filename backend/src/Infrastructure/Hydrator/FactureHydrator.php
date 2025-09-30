<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Application\Dto\Input\Facture\ReportInputDto;

final class FactureHydrator
{
  /**
   * Hydrate SOAP request for GetReport (FACTURE)
   * Business parameters only - authentication handled by SoapClient
   */
  public function hydrateReport(ReportInputDto $inputDto): object
  {
    return (object) [
      'ReportType' => 'FACTURE',
      'ParamsFiltres' => 'PKFACTURE=' . $inputDto->pkFacture
    ];
  }
}
