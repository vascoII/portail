<?php

declare(strict_types=1);

namespace App\Application\Factory\Logement;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Logement\GetInfosAppareilsByLogementInpuDto;
use App\Application\Dto\Input\Logement\GetInfosLogementsInputDto;
use App\Application\Dto\Input\Logement\GetNbTicketsInterByLogementInputDto;
use App\Application\Dto\Input\Logement\GetOccupants4ChgtInputDto;
use App\Application\Dto\Input\Logement\GetStatOccupantsGraphInputDto;
use App\Application\Dto\Input\Logement\GetTableauBordLogementInputDto;
use App\Application\Dto\Input\Logement\SetOccupants4ChgtInputDto;
use App\Application\Dto\Input\Logement\SetSeuilConsoInputDto;

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
}
