<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Immeuble\GetTableauBordImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosAnomaliesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosLogementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDepannagesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDysfonctionnementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosFuitesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosImmeublesInputDto;

final class ImmeubleHydrator
{
  public function hydrateGetTableauBordImmeuble(GetTableauBordImmeubleInputDto $inputDto): object
  {
    return (object) [
      'PkImmeuble' => $inputDto->pkImmeuble
    ];
  }

  public function hydrateGetInfosAnomaliesByImmeuble(GetInfosAnomaliesByImmeubleInputDto $inputDto): object
  {
    return (object) [
      'PkImmeuble' => $inputDto->pkImmeuble,
      'ParamsFiltres' => $inputDto->paramsFiltres
    ];
  }

  public function hydrateGetInfosLogementsByImmeuble(GetInfosLogementsByImmeubleInputDto $inputDto): object
  {
    return (object) [
      'ParamsFiltres' => $inputDto->paramsFiltres,
      'ParamsInfos' => $inputDto->paramsInfos
    ];
  }

  public function hydrateGetInfosDepannagesByImmeuble(GetInfosDepannagesByImmeubleInputDto $inputDto): object
  {
    return (object) [
      'PkImmeuble' => $inputDto->pkImmeuble,
      'ParamsFiltres' => $inputDto->paramsFiltres
    ];
  }
  
  public function hydrateGetInfosDysfonctionnementsByImmeuble(GetInfosDysfonctionnementsByImmeubleInputDto $inputDto): object
  {
    return (object) [
      'PkImmeuble' => $inputDto->pkImmeuble,
      'ParamsFiltres' => $inputDto->paramsFiltres
    ];
  }

  public function hydrateGetInfosFuitesByImmeuble(GetInfosFuitesByImmeubleInputDto $inputDto): object
  {
    return (object) [
      'PkImmeuble' => $inputDto->pkImmeuble,
      'ParamsFiltres' => $inputDto->paramsFiltres
    ];
  }

  public function hydrateGetInfosImmeubles(GetInfosImmeublesInputDto $inputDto): object
  {
    return (object) [
      'PkUserChild' => $inputDto->pkUser,
      'ParamsFiltres' => $inputDto->paramsFiltres,
      'ParamsInfos' => $inputDto->paramsInfos
    ];
  }
}
