<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Input\Immeuble\InterventionsInputDto;
use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Input\Immeuble\InterventionInputDto;
use App\Application\Dto\Input\Immeuble\LeaksInputDto;
use App\Application\Dto\Input\Immeuble\DysfunctionsInputDto;
use App\Application\Dto\Input\Immeuble\AnomaliesInputDto;
use App\Application\Dto\Input\Immeuble\FilterResultInputDto;

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
  public function hydrateListInterventions(InterventionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on InterventionsInputDto properties
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
  public function hydrateIntervention(InterventionInputDto $inputDto, AuthenticationContext $authContext): object
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
  public function hydrateListLeaks(LeaksInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on LeaksInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for listDysfunctions
   */
  public function hydrateListDysfunctions(DysfunctionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on DysfunctionsInputDto properties
    ];
  }

  /**
   * Hydrate SOAP request for listAnomalies
   */
  public function hydrateListAnomalies(AnomaliesInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on AnomaliesInputDto properties
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
