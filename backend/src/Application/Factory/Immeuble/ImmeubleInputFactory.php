<?php

declare(strict_types=1);

namespace App\Application\Factory\Immeuble;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Immeuble\AnomaliesInputDto;
use App\Application\Dto\Input\Immeuble\DysfunctionsInputDto;
use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosAnomaliesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDepannagesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDysfonctionnementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosFuitesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosImmeublesInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosLogementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetTableauBordImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Input\Immeuble\InterventionInputDto;
use App\Application\Dto\Input\Immeuble\InterventionsInputDto;
use App\Application\Dto\Input\Immeuble\LeaksInputDto;
use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;

final class ImmeubleInputFactory
{
  public function createGetInfosAnomaliesByImmeubleFromRequest(Request $request): GetInfosAnomaliesByImmeubleInputDto
  {
    return new GetInfosAnomaliesByImmeubleInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('paramsFiltres')
    );
  }

  public function createGetInfosDepannagesByImmeubleFromRequest(Request $request): GetInfosDepannagesByImmeubleInputDto
  {
    return new GetInfosDepannagesByImmeubleInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('paramsFiltres')
    );
  }

  public function createGetInfosDysfonctionnementsByImmeubleFromRequest(Request $request): GetInfosDysfonctionnementsByImmeubleInputDto
  {
    return new GetInfosDysfonctionnementsByImmeubleInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('paramsFiltres')
    );
  }

  public function createGetInfosFuitesByImmeubleFromRequest(Request $request): GetInfosFuitesByImmeubleInputDto
  {
    return new GetInfosFuitesByImmeubleInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('paramsFiltres')
    );
  }

  public function createGetInfosImmeublesFromRequest(Request $request): GetInfosImmeublesInputDto
  {
    return new GetInfosImmeublesInputDto(
      (int) $request->query->get('pkUser'),
      (string) $request->query->get('paramsFiltres'),
      (string) $request->query->get('paramsInfos')
    );
  }

  public function createGetInfosLogementsByImmeubleFromRequest(Request $request): GetInfosLogementsByImmeubleInputDto
  {
    return new GetInfosLogementsByImmeubleInputDto(
      (string) $request->query->get('paramsFiltres'),
      (string) $request->query->get('paramsInfos')
    );
  }

  public function createGetTableauBordImmeubleFromRequest(Request $request): GetTableauBordImmeubleInputDto
  {
    return new GetTableauBordImmeubleInputDto((string) $request->query->get('pkImmeuble'));
  }

  // Methods for simple Input DTOs used by actions
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
    return new InterventionInputDto((string) $request->query->get('pkImmeuble'));
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

  public function createInterventionFromRoute(Request $request, string $pkImmeubleParam): InterventionInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new InterventionInputDto($pkImmeuble);
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
}
