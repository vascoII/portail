<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\GestionParc\IndexInputDto;
use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Input\GestionParc\ExportInterventionsInputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Input\GestionParc\ExportLeaksInputDto;
use App\Application\Dto\Input\GestionParc\ExportAnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\ListInterventionsInputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Input\GestionParc\ListLeaksInputDto;
use App\Application\Dto\Input\GestionParc\ListAnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\GestionParc\ListDysfunctionsInputDto;

final class GestionParcHydrator
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

  public function hydrateReport(ReportInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'GESTIONPARC',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
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

  public function hydrateListInterventions(ListInterventionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ListInterventionsInputDto properties
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

  public function hydrateFilterResult(FilterResultInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on FilterResultInputDto properties
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

  public function hydrateListAnomalies(ListAnomaliesInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ListAnomaliesInputDto properties
    ];
  }

  public function hydrateExportInterventions(ExportInterventionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'INTERVENTIONS_GESTIONPARC',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  public function hydrateExportLeaks(ExportLeaksInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'LEAKS_GESTIONPARC',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  public function hydrateExportAnomalies(ExportAnomaliesInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'ANOMALIES_GESTIONPARC',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  public function hydrateExportDysfunctions(ExportDysfunctionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'DYSFUNCTIONS_GESTIONPARC',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
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
