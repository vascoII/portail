<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

interface OccupantDataSourceInterface
{
    public function fetchGetOccupantIntervention(GetByIdIntInputDto $inputDto): object;

    public function fetchGetOccupantReleveEau(): object;

    public function fetchGetOccupantReleveNote(GetByEnergyStringInputDto $inputDto): object;

    public function fetchGetOccupantReleveRepart(): object;
}
