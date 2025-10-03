<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Input\GestionParc\InterventionsInputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Input\GestionParc\LeaksInputDto;
use App\Application\Dto\Input\GestionParc\AnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\DysfunctionsInputDto;

final class GestionParcHydrator
{
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

  public function hydrateListInterventions(InterventionsInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on InterventionsInputDto properties
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

  public function hydrateListLeaks(LeaksInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on LeaksInputDto properties
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
