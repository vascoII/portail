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

  // Methods for route parameters
  public function createReportFromRoute(Request $request, string $pkImmeubleParam, string $typeParam, string $energieParam): ReportInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    $type = (string) $request->attributes->get($typeParam);
    $energie = (string) $request->attributes->get($energieParam);
    return new ReportInputDto($pkImmeuble, $type, $energie);
  }

  public function createShowFromRoute(Request $request, string $pkImmeubleParam): ShowInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new ShowInputDto($pkImmeuble);
  }

  public function createShowInterventionFromRoute(Request $request, string $pkImmeubleParam, string $pkInterventionParam): ShowInterventionInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    $pkIntervention = (string) $request->attributes->get($pkInterventionParam);
    return new ShowInterventionInputDto($pkImmeuble, $pkIntervention);
  }

  public function createAnomaliesFromRoute(Request $request, string $pkImmeubleParam): AnomaliesInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new AnomaliesInputDto($pkImmeuble);
  }

  public function createDysfunctionsFromRoute(Request $request, string $pkImmeubleParam): DysfunctionsInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new DysfunctionsInputDto($pkImmeuble);
  }

  public function createInterventionsFromRoute(Request $request, string $pkImmeubleParam): InterventionsInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new InterventionsInputDto($pkImmeuble);
  }

  public function createLeaksFromRoute(Request $request, string $pkImmeubleParam): LeaksInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new LeaksInputDto($pkImmeuble);
  }
}
