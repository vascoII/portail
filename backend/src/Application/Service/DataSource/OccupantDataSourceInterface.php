<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;

interface OccupantDataSourceInterface
{
	public function fetchGetOccupantReleveEau(): object;
	public function fetchGetOccupantReleveRepart(): object;
	public function fetchGetOccupantReleveNote(GetByEnergyStringInputDto $inputDto): object;
	public function fetchGetOccupantIntervention(GetByIdIntInputDto $inputDto): object;
}
