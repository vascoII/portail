<?php

declare(strict_types=1);

namespace App\Application\Factory\Occupant;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Occupant\AnomaliesInputDto;
use App\Application\Dto\Input\Occupant\DysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\EditInputDto;
use App\Application\Dto\Input\Occupant\InterventionsInputDto;
use App\Application\Dto\Input\Occupant\LeaksInputDto;
use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInputDto;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;

final class OccupantInputFactory
{
  // Methods for query parameters
  public function createAnomaliesFromRequest(Request $request): AnomaliesInputDto
  {
    return new AnomaliesInputDto();
  }

  public function createDysfunctionsFromRequest(Request $request): DysfunctionsInputDto
  {
    return new DysfunctionsInputDto();
  }

  public function createEditFromRequest(Request $request): EditInputDto
  {
    return new EditInputDto((string) $request->query->get('pkLogement'));
  }

  public function createInterventionsFromRequest(Request $request): InterventionsInputDto
  {
    return new InterventionsInputDto();
  }

  public function createLeaksFromRequest(Request $request): LeaksInputDto
  {
    return new LeaksInputDto();
  }

  public function createMyAccountFromRequest(Request $request): MyAccountInputDto
  {
    return new MyAccountInputDto();
  }

  public function createShowEauReleveFromRequest(Request $request): ShowEauReleveInputDto
  {
    return new ShowEauReleveInputDto((string) $request->query->get('pkOccupant'));
  }

  public function createShowFromRequest(Request $request): ShowInputDto
  {
    return new ShowInputDto();
  }

  public function createShowInterventionFromRequest(Request $request): ShowInterventionInputDto
  {
    return new ShowInterventionInputDto((string) $request->query->get('pkIntervention'));
  }

  public function createShowNoteReleveFromRequest(Request $request): ShowNoteReleveInputDto
  {
    return new ShowNoteReleveInputDto(
      (string) $request->query->get('pkOccupant'),
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('energie')
    );
  }

  public function createShowRepartReleveFromRequest(Request $request): ShowRepartReleveInputDto
  {
    return new ShowRepartReleveInputDto(
      (string) $request->query->get('pkOccupant'),
      (string) $request->query->get('pkImmeuble')
    );
  }

  public function createSimulateurFromRequest(Request $request): SimulateurInputDto
  {
    return new SimulateurInputDto();
  }

  // Methods for route parameters
  public function createAnomaliesFromRoute(Request $request, string $pkLogementParam): AnomaliesInputDto
  {
    return new AnomaliesInputDto();
  }

  public function createDysfunctionsFromRoute(Request $request, string $pkLogementParam): DysfunctionsInputDto
  {
    return new DysfunctionsInputDto();
  }

  public function createEditFromRoute(Request $request, string $pkLogementParam): EditInputDto
  {
    $pkLogement = (string) $request->attributes->get($pkLogementParam);
    return new EditInputDto($pkLogement);
  }

  public function createInterventionsFromRoute(Request $request, string $pkLogementParam): InterventionsInputDto
  {
    return new InterventionsInputDto();
  }

  public function createLeaksFromRoute(Request $request, string $pkLogementParam): LeaksInputDto
  {
    return new LeaksInputDto();
  }

  public function createMyAccountFromRoute(Request $request): MyAccountInputDto
  {
    return new MyAccountInputDto();
  }

  public function createShowEauReleveFromRoute(Request $request, string $pkOccupantParam): ShowEauReleveInputDto
  {
    $pkOccupant = (string) $request->attributes->get($pkOccupantParam);
    return new ShowEauReleveInputDto($pkOccupant);
  }

  public function createShowFromRoute(Request $request, string $pkLogementParam): ShowInputDto
  {
    return new ShowInputDto();
  }

  public function createShowInterventionFromRoute(Request $request, string $pkInterventionParam): ShowInterventionInputDto
  {
    $pkIntervention = (string) $request->attributes->get($pkInterventionParam);
    return new ShowInterventionInputDto($pkIntervention);
  }

  public function createShowNoteReleveFromRoute(Request $request, string $pkOccupantParam, string $pkImmeubleParam, string $energieParam): ShowNoteReleveInputDto
  {
    $pkOccupant = (string) $request->attributes->get($pkOccupantParam);
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    $energie = (string) $request->attributes->get($energieParam);
    return new ShowNoteReleveInputDto($pkOccupant, $pkImmeuble, $energie);
  }

  public function createShowRepartReleveFromRoute(Request $request, string $pkOccupantParam, string $pkImmeubleParam): ShowRepartReleveInputDto
  {
    $pkOccupant = (string) $request->attributes->get($pkOccupantParam);
    $pkImmeuble = (string) $request->attributes->get($pkImmeubleParam);
    return new ShowRepartReleveInputDto($pkOccupant, $pkImmeuble);
  }

  public function createSimulateurFromRoute(Request $request, string $pkLogementParam): SimulateurInputDto
  {
    return new SimulateurInputDto();
  }
}
