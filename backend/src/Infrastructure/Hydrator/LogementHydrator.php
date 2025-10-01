<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Application\Dto\Input\Logement\GetTableauBordLogementInputDto;
use App\Application\Dto\Input\Logement\GetNbTicketsInterByLogementInputDto;
use App\Application\Dto\Input\Logement\SetOccupants4ChgtInputDto;
use App\Application\Dto\Input\Logement\GetOccupants4ChgtInputDto;
use App\Application\Dto\Input\Logement\SetSeuilConsoInputDto;
use App\Application\Dto\Input\Logement\GetStatOccupantsGraphInputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilsByLogementInpuDto;
use App\Application\Dto\Input\Logement\GetInfosLogementsInputDto;

final class LogementHydrator
{
  
  public function hydrateGetTableauBordLogement(GetTableauBordLogementInputDto $inputDto): object
  {
    return (object) [
      'PkLogement' => $inputDto->pkLogement,
      'PkOccupant' => $inputDto->pkOccupant,
    ];
  }

  public function hydrateGetNbTicketsInterByLogement(GetNbTicketsInterByLogementInputDto $inputDto): object
  {
    return (object) [
      'PkLogement'     => $inputDto->pkLogement,
      'ParamsFiltres' => $inputDto->paramsFilters,
    ];
  }

  public function hydrateSetOccupants4Chgt(SetOccupants4ChgtInputDto $inputDto): object
  {
    return (object) [
      
    ];
  }

  public function hydrateGetOccupants4Chgt(GetOccupants4ChgtInputDto $inputDto): object
  {
    return (object) [
      'PkImmeuble' => $inputDto->pkImmeuble,
      'PkOccupant' => $inputDto->pkOccupant,
			'isNew'		 => $inputDto->IsNew
    ];
  }

  public function hydrateSetSeuilConso(SetSeuilConsoInputDto $inputDto): object
  {
    return (object) [
      'ParamsFiltres' => sprintf(
        'SEUIL_CONSO_EF=%d|SEUIL_CONSO_EC=%d|SEUIL_CONSO_ACTIF=%s|SEUIL_CONSO_EMAIL=%s',
        $inputDto->seuilConsoEf, $inputDto->seuilConsoEc, $inputDto->seuilConsoActif, $inputDto->seuilConsoEmail
        )
    ];
  }

  public function hydrateGetStatOccupantsGraph(): object
  {
    return (object) [
      'typeGraph' => 'CONNEXIONS_UNIQUES',
      'startDate' => '',
			'endDate'		=> '',
    ];
  }

  public function hydrateGetInfosAppareilsByLogement(GetInfosAppareilsByLogementInpuDto $inputDto): object
  {
    return (object) [
      'PkLogement' => $inputDto->pkLogement,
    ];
  }

  public function hydrateGetInfosLogements(GetInfosLogementsInputDto $inputDto): object
  {
    return (object) [
      'ParamsFiltres' => $inputDto->paramsFiltres,
      'ParamsInfos'   => $inputDto->paramsInfos,
    ];
  }

}
