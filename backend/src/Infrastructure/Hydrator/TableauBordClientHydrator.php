<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;

final class TableauBordClientHydrator
{
  public function hydrateIndex(IndexInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on IndexInputDto properties
    ];
  }

  public function hydrateIntervention(InterventionInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on InterventionInputDto properties
    ];
  }
}
