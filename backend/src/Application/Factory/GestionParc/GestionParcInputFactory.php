<?php

declare(strict_types=1);

namespace App\Application\Factory\GestionParc;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\GestionParc\AnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\DysfunctionsInputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Input\GestionParc\InterventionsInputDto;
use App\Application\Dto\Input\GestionParc\LeaksInputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;

final class GestionParcInputFactory
{
  public function createAnomaliesFromRequest(Request $request): AnomaliesInputDto
  {
    return new AnomaliesInputDto((string) $request->query->get('pkImmeuble'));
  }

  public function createDysfunctionsFromRequest(Request $request): DysfunctionsInputDto
  {
    return new DysfunctionsInputDto((string) $request->query->get('pkImmeuble'));
  }

  public function createFilterResultFromRequest(Request $request): FilterResultInputDto
  {
    return new FilterResultInputDto();
  }

  public function createInterventionFromRequest(Request $request): InterventionInputDto
  {
    return new InterventionInputDto();
  }

  public function createInterventionsFromRequest(Request $request): InterventionsInputDto
  {
    return new InterventionsInputDto((string) $request->query->get('pkImmeuble'));
  }

  public function createLeaksFromRequest(Request $request): LeaksInputDto
  {
    return new LeaksInputDto((string) $request->query->get('pkImmeuble'));
  }

  public function createReportFromRequest(Request $request): ReportInputDto
  {
    return new ReportInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('type'),
      (string) $request->query->get('energie')
    );
  }

  public function createShowFromRequest(Request $request): ShowInputDto
  {
    return new ShowInputDto((string) $request->query->get('pkImmeuble'));
  }

  public function createShowInterventionFromRequest(Request $request): ShowInterventionInputDto
  {
    return new ShowInterventionInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('pkIntervention')
    );
  }
}
