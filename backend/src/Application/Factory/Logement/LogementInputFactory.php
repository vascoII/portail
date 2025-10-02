<?php

declare(strict_types=1);

namespace App\Application\Factory\Logement;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Logement\AnomaliesInputDto;
use App\Application\Dto\Input\Logement\CreateTicketImmeubleInputDto;
use App\Application\Dto\Input\Logement\CreateTicketInputDto;
use App\Application\Dto\Input\Logement\DysfunctionsInputDto;
use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Input\Logement\ExportInputDto;
use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilsByLogementInpuDto;
use App\Application\Dto\Input\Logement\GetInfosLogementsInputDto;
use App\Application\Dto\Input\Logement\GetNbTicketsInterByLogementInputDto;
use App\Application\Dto\Input\Logement\GetOccupants4ChgtInputDto;
use App\Application\Dto\Input\Logement\GetStatOccupantsGraphInputDto;
use App\Application\Dto\Input\Logement\GetTableauBordLogementInputDto;
use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Input\Logement\GuideInputDto;
use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Input\Logement\InterventionsInputDto;
use App\Application\Dto\Input\Logement\LeaksInputDto;
use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Input\Logement\SetOccupants4ChgtInputDto;
use App\Application\Dto\Input\Logement\SetSeuilConsoInputDto;
use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;

final class LogementInputFactory
{
  public function createGetInfosAppareilsByLogementFromRequest(Request $request): GetInfosAppareilsByLogementInpuDto
  {
    return new GetInfosAppareilsByLogementInpuDto((int) $request->query->get('pkLogement'));
  }

  public function createGetInfosLogementsFromRequest(Request $request): GetInfosLogementsInputDto
  {
    return new GetInfosLogementsInputDto(
      (string) $request->query->get('paramsFiltres'),
      (string) $request->query->get('paramsInfos')
    );
  }

  public function createGetNbTicketsInterByLogementFromRequest(Request $request): GetNbTicketsInterByLogementInputDto
  {
    return new GetNbTicketsInterByLogementInputDto(
      (int) $request->query->get('pkLogement'),
      (string) $request->query->get('paramsFilters')
    );
  }

  public function createGetOccupants4ChgtFromRequest(Request $request): GetOccupants4ChgtInputDto
  {
    return new GetOccupants4ChgtInputDto(
      (int) $request->query->get('pkImmeuble'),
      (int) $request->query->get('pkOccupant'),
      (bool) $request->query->get('IsNew')
    );
  }

  public function createGetStatOccupantsGraphFromRequest(Request $request): GetStatOccupantsGraphInputDto
  {
    return new GetStatOccupantsGraphInputDto((string) $request->query->get('pkLogement'));
  }

  public function createGetTableauBordLogementFromRequest(Request $request): GetTableauBordLogementInputDto
  {
    return new GetTableauBordLogementInputDto(
      (int) $request->query->get('pkLogement'),
      (int) $request->query->get('pkOccupant')
    );
  }

  public function createSetOccupants4ChgtFromRequest(Request $request): SetOccupants4ChgtInputDto
  {
    return new SetOccupants4ChgtInputDto((string) $request->request->get('pkLogement'));
  }

  public function createSetSeuilConsoFromRequest(Request $request): SetSeuilConsoInputDto
  {
    return new SetSeuilConsoInputDto(
      (int) $request->request->get('seuilConsoEf'),
      (int) $request->request->get('seuilConsoEc'),
      (int) $request->request->get('seuilConsoActif'),
      (int) $request->request->get('seuilConsoEmail')
    );
  }

  // Methods for simple Input DTOs used by actions
  public function createAnomaliesFromRequest(Request $request): AnomaliesInputDto
  {
    return new AnomaliesInputDto((string) $request->query->get('pkLogement'));
  }

  public function createCreateTicketFromRequest(Request $request): CreateTicketInputDto
  {
    return new CreateTicketInputDto((string) $request->query->get('pkLogement'));
  }

  public function createCreateTicketImmeubleFromRequest(Request $request): CreateTicketImmeubleInputDto
  {
    return new CreateTicketImmeubleInputDto((string) $request->query->get('pkImmeuble'));
  }

  public function createDysfunctionsFromRequest(Request $request): DysfunctionsInputDto
  {
    return new DysfunctionsInputDto((string) $request->query->get('pkLogement'));
  }

  public function createEditFromRequest(Request $request): EditInputDto
  {
    return new EditInputDto((string) $request->query->get('pkLogement'));
  }

  public function createExportFromRequest(Request $request): ExportInputDto
  {
    return new ExportInputDto((string) $request->query->get('pkLogement'));
  }

  public function createFilterResultFromRequest(Request $request): FilterResultInputDto
  {
    return new FilterResultInputDto();
  }

  public function createGetInfosAppareilFromRequest(Request $request): GetInfosAppareilInputDto
  {
    return new GetInfosAppareilInputDto();
  }

  public function createGetTicketOnwerFromRequest(Request $request): GetTicketOnwerInputDto
  {
    return new GetTicketOnwerInputDto((string) $request->query->get('pkImmeuble'));
  }

  public function createGuideFromRequest(Request $request): GuideInputDto
  {
    return new GuideInputDto((string) $request->query->get('pkLogement'));
  }

  public function createIndexFromRequest(Request $request): IndexInputDto
  {
    return new IndexInputDto((string) $request->query->get('pkImmeuble'));
  }

  public function createInterventionsFromRequest(Request $request): InterventionsInputDto
  {
    return new InterventionsInputDto((string) $request->query->get('pkLogement'));
  }

  public function createLeaksFromRequest(Request $request): LeaksInputDto
  {
    return new LeaksInputDto((string) $request->query->get('pkLogement'));
  }

  public function createSearchFromRequest(Request $request): SearchInputDto
  {
    return new SearchInputDto((string) $request->query->get('pkLogement'));
  }

  public function createShowFromRequest(Request $request): ShowInputDto
  {
    return new ShowInputDto((string) $request->query->get('pkLogement'));
  }

  public function createShowInterventionFromRequest(Request $request): ShowInterventionInputDto
  {
    return new ShowInterventionInputDto(
      (string) $request->query->get('pkLogement'),
      (string) $request->query->get('pkIntervention')
    );
  }

  public function createShowRepartReleveFromRequest(Request $request): ShowRepartReleveInputDto
  {
    return new ShowRepartReleveInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('pkLogement')
    );
  }

  // Methods for route parameters
  public function createAnomaliesFromRoute(Request $request, string $pkLogementParam): AnomaliesInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new AnomaliesInputDto($pkLogement);
  }

  public function createCreateTicketFromRoute(Request $request, string $pkLogementParam): CreateTicketInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new CreateTicketInputDto($pkLogement);
  }

  public function createCreateTicketImmeubleFromRoute(Request $request, string $pkImmeubleParam): CreateTicketImmeubleInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new CreateTicketImmeubleInputDto($pkImmeuble);
  }

  public function createDysfunctionsFromRoute(Request $request, string $pkLogementParam): DysfunctionsInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new DysfunctionsInputDto($pkLogement);
  }

  public function createEditFromRoute(Request $request, string $pkLogementParam): EditInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new EditInputDto($pkLogement);
  }

  public function createExportFromRoute(Request $request, string $pkImmeubleParam): ExportInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new ExportInputDto($pkImmeuble);
  }

  public function createGetInfosAppareilFromRoute(Request $request, string $pkLogementParam): GetInfosAppareilInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new GetInfosAppareilInputDto($pkLogement);
  }

  public function createGetTicketOnwerFromRoute(Request $request, string $pkImmeubleParam): GetTicketOnwerInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new GetTicketOnwerInputDto($pkImmeuble);
  }

  public function createGuideFromRoute(Request $request, string $pkLogementParam): GuideInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new GuideInputDto($pkLogement);
  }

  public function createIndexFromRoute(Request $request, string $pkImmeubleParam): IndexInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new IndexInputDto($pkImmeuble);
  }

  public function createInterventionsFromRoute(Request $request, string $pkLogementParam): InterventionsInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new InterventionsInputDto($pkLogement);
  }

  public function createLeaksFromRoute(Request $request, string $pkLogementParam): LeaksInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new LeaksInputDto($pkLogement);
  }

  public function createSearchFromRoute(Request $request, string $pkLogementParam): SearchInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new SearchInputDto($pkLogement);
  }

  public function createShowFromRoute(Request $request, string $pkLogementParam): ShowInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new ShowInputDto($pkLogement);
  }

  public function createShowInterventionFromRoute(Request $request, string $pkLogementParam, string $pkInterventionParam): ShowInterventionInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    $pkIntervention = (string) $request->attributes->get($pkInterventionParam);
    return new ShowInterventionInputDto($pkLogement, $pkIntervention);
  }

  public function createShowRepartReleveFromRoute(Request $request, string $pkImmeubleParam, string $pkLogementParam): ShowRepartReleveInputDto
  {
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new ShowRepartReleveInputDto($pkImmeuble, $pkLogement);
  }
}
