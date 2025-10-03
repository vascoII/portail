<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Input\Occupant\AnomaliesInputDto;
use App\Application\Dto\Input\Occupant\DysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\InterventionsInputDto;
use App\Application\Dto\Input\Occupant\LeaksInputDto;
use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Application\Dto\Input\Occupant\EditInputDto;

final class OccupantHydrator
{
  public function hydrateAlertes(AlertesInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on AlertesInputDto properties
    ];
  }

  public function hydrateListAnomalies(AnomaliesInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on AnomaliesInputDto properties
    ];
  }

  public function hydrateListDysfunctions(DysfunctionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on DysfunctionsInputDto properties
    ];
  }

  public function hydrateListInterventions(InterventionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on InterventionsInputDto properties
    ];
  }

  public function hydrateListLeaks(LeaksInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on LeaksInputDto properties
    ];
  }

  public function hydrateMyAccount(MyAccountInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on MyAccountInputDto properties
    ];
  }

  public function hydrateShowEauReleve(ShowEauReleveInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ShowEauReleveInputDto properties
    ];
  }

  public function hydrateShowIntervention(ShowInterventionInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ShowInterventionInputDto properties
    ];
  }

  public function hydrateShowNoteReleve(ShowNoteReleveInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ShowNoteReleveInputDto properties
    ];
  }

  public function hydrateShowRepartReleve(ShowRepartReleveInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ShowRepartReleveInputDto properties
    ];
  }

  public function hydrateShow(ShowInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ShowInputDto properties
    ];
  }

  public function hydrateSimulateur(SimulateurInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on SimulateurInputDto properties
    ];
  }

  public function hydrateEdit(EditInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on SimulateurInputDto properties
    ];
  }
}
