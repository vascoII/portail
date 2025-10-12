<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

interface OccupantDataSourceInterface
{

	public function fetchGetOccupant(): object;
	public function fetchListAnomaliesByOccupant(): object;
	public function fetchListDysfonctionnementsByOccupant(): object;
	public function fetchListFuitesByOccupant(): object;
	public function fetchListInterventionsByOccupant(): object;
	public function fetchListAlertesByOccupant(): object;
	public function fetchGetOccupantAccount(): object;
}
