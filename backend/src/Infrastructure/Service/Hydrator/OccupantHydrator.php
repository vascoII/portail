<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

final class OccupantHydrator
{
    public function hydrateGetOccupantIntervention(GetByIdIntInputDto $inputDto): object
    {
        return (object) [
            'Id' => $inputDto->id,
            // TODO: Add specific parameters when SOAP method is known
        ];
    }

    public function hydrateGetOccupantReleveEau(): object
    {
        return (object) [
            // TODO: Add specific parameters when SOAP method is known
        ];
    }

    public function hydrateGetOccupantReleveNote(GetByEnergyStringInputDto $inputDto): object
    {
        return (object) [
            'Energy' => $inputDto->energy,
            // TODO: Add specific parameters when SOAP method is known
        ];
    }

    public function hydrateGetOccupantReleveRepart(): object
    {
        return (object) [
            // TODO: Add specific parameters when SOAP method is known
        ];
    }
}
