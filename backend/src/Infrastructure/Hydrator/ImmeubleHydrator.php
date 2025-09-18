<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Input\Immeuble\ListInterventionsInputDto;
use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Input\Immeuble\LinterventionInputDto;
use App\Application\Dto\Input\Immeuble\ListLeaksInputDto;
use App\Application\Dto\Input\Immeuble\ListDysfunctionsInputDto;
use App\Application\Dto\Input\Immeuble\ListAnomaliesInputDto;
use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use App\Application\Dto\Input\Immeuble\ExportInterventionsInputDto;
use App\Application\Dto\Input\Immeuble\ExportLeaksInputDto;
use App\Application\Dto\Input\Immeuble\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\Immeuble\ExportAnomaliesInputDto;

final class ImmeubleHydrator
{
  /**
   * Hydrate SOAP request for getImmeubles
   */
  public function hydrateIndex(IndexInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on IndexInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for showImmeuble
   */
  public function hydrateShow(ShowInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ShowInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for GetReport (IMMEUBLE)
   */
  public function hydrateReport(ReportInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'IMMEUBLE',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  /**
   * Hydrate SOAP request for listInterventions
   */
  public function hydrateListInterventions(ListInterventionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ListInterventionsInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for showIntervention
   */
  public function hydrateShowIntervention(ShowInterventionInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ShowInterventionInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for lintervention
   */
  public function hydrateLintervention(LinterventionInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on LinterventionInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for listLeaks
   */
  public function hydrateListLeaks(ListLeaksInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ListLeaksInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for listDysfunctions
   */
  public function hydrateListDysfunctions(ListDysfunctionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ListDysfunctionsInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for listAnomalies
   */
  public function hydrateListAnomalies(ListAnomaliesInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on ListAnomaliesInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for filterResult
   */
  public function hydrateFilterResult(FilterResultInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on FilterResultInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for exportInterventions
   */
  public function hydrateExportInterventions(ExportInterventionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'INTERVENTIONS_IMMEUBLE',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  /**
   * Hydrate SOAP request for exportLeaks
   */
  public function hydrateExportLeaks(ExportLeaksInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'LEAKS_IMMEUBLE',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  /**
   * Hydrate SOAP request for exportDysfunctions
   */
  public function hydrateExportDysfunctions(ExportDysfunctionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'DYSFUNCTIONS_IMMEUBLE',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  /**
   * Hydrate SOAP request for exportAnomalies
   */
  public function hydrateExportAnomalies(ExportAnomaliesInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      'ReportType' => 'ANOMALIES_IMMEUBLE',
      'ParamsFiltres' => $this->buildParamsFiltres($inputDto)
    ];
  }

  /**
   * Build ParamsFiltres string from DTO properties
   */
  private function buildParamsFiltres(object $inputDto): string
  {
    $filters = [];

    // Map common DTO properties to SOAP parameters
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
