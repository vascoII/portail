<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Input\Occupant\ExportAnomaliesInputDto;
use App\Application\Dto\Input\Occupant\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\ExportInterventionsInputDto;
use App\Application\Dto\Input\Occupant\ExportLeaksInputDto;
use App\Application\Dto\Input\Occupant\ListAnomaliesInputDto;
use App\Application\Dto\Input\Occupant\ListDysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\ListInterventionsInputDto;
use App\Application\Dto\Input\Occupant\ListLeaksInputDto;
use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;

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

  public function hydrateExportAnomalies(ExportAnomaliesInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'ANOMALIES_OCCUPANT',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  public function hydrateExportDysfunctions(ExportDysfunctionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'DYSFUNCTIONS_OCCUPANT',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  public function hydrateExportInterventions(ExportInterventionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'INTERVENTIONS_OCCUPANT',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  public function hydrateExportLeaks(ExportLeaksInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'LEAKS_OCCUPANT',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  public function hydrateListAnomalies(ListAnomaliesInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ListAnomaliesInputDto properties
    ];
  }

  public function hydrateListDysfunctions(ListDysfunctionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ListDysfunctionsInputDto properties
    ];
  }

  public function hydrateListInterventions(ListInterventionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ListInterventionsInputDto properties
    ];
  }

  public function hydrateListLeaks(ListLeaksInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ListLeaksInputDto properties
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

  private function buildParamsFiltres(object $inputDto): string
  {
    $filters = [];

    $propertyMap = [
      'pkImmeuble' => 'PKIMMEUBLE',
      'pkLogement' => 'PKLOGEMENT',
      'pkOccupant' => 'PKOCCUPANT',
      'pkIntervention' => 'PKINTERVENTION',
      'pkFacture' => 'PKFACTURE',
      'workOrderNumber' => 'WORKORDERNUMBER',
      'date' => 'DATE',
      'date1' => 'DATE1',
      'date2' => 'DATE2',
    ];

    foreach ($propertyMap as $dtoProperty => $soapProperty) {
      if (property_exists($inputDto, $dtoProperty) && $inputDto->$dtoProperty !== null) {
        $filters[] = $soapProperty . '=' . $inputDto->$dtoProperty;
      }
    }

    return implode('|', $filters);
  }
}
