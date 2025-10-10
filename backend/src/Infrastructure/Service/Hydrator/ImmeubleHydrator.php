<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

final class ImmeubleHydrator
{

    public function hydrateGetListImmeubles(): object
    {
        return (object) [
          'PkUserChild' => -1,
          "ParamsInfos" => "NBCOMPTEURS=O|NBFUITES=O|NBDEPANNAGES=O|NBDYSFONCTIONNEMENTS=O|NBANOMALIES=O",
          "ParamsFiltres" => ""
        ];
    }

    public function hydrateGetImmeuble(GetByIdIntInputDto $inputDto): object
    {
      return (object) [
        'PkImmeuble' => $inputDto->id,
      ];
    }

    public function hydrateListAnomaliesByImmeuble(GetByIdIntInputDto $inputDto): object
    {
      return (object) [
        'PkImmeuble' => $inputDto->id,
        'ParamsFiltres' => ""
      ];
    }

    public function hydrateListDysfonctionnementsByImmeuble(GetByIdIntInputDto $inputDto): object
    {
      return (object) [
        'PkImmeuble' => $inputDto->id,
        'ParamsFiltres' => ""
      ];
    }
    
    public function hydrateListFuitesByImmeuble(GetByIdIntInputDto $inputDto): object
    {
      return (object) [
        'PkImmeuble' => $inputDto->id,
        'ParamsFiltres' => ""
      ];
    }

    public function hydrateListInterventionsByImmeuble(GetByIdIntInputDto $inputDto): object
    {
      return (object) [
        'PkImmeuble' => $inputDto->id,
        'ParamsFiltres' => ""
      ];
    }

    public function hydrateListLogementsByImmeuble(GetByIdIntInputDto $inputDto): object
    {
      return (object) [
        'PkImmeuble' => $inputDto->id,
        'ParamsFiltres' => ""
      ];
    }
  
}
