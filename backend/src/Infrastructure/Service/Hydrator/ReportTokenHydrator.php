<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\ReportToken\ReportInputDto;

final class ReportTokenHydrator
{
  public function hydrateReport(ReportInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ReportInputDto properties
    ];
  }
}
