<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\Intervention\ReportInputDto;

final class InterventionHydrator
{
  public function hydrateReport(ReportInputDto $inputDto): object
  {
    return (object) [
      'ReportType' => 'INTERVENTION',
      'ParamsFiltres' => 'WORKORDERNUMBER=' . $inputDto->pkDepannage
    ];
  }
}
