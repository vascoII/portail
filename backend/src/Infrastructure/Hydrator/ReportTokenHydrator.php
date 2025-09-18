<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\ReportToken\LoadingInputDto;
use App\Application\Dto\Input\ReportToken\ReportInputDto;

final class ReportTokenHydrator
{
  public function hydrateLoading(LoadingInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on LoadingInputDto properties
    ];
  }

  public function hydrateReport(ReportInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ReportInputDto properties
    ];
  }
}
