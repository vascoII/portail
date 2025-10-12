<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

interface LogementDataSourceInterface
{

	public function fetchGetLogements(GetByIdIntInputDto $inputDto): object;
	public function fetchGetLogement(GetByIdIntInputDto $inputDto): object;
	public function fetchListAnomaliesByLogement(GetByIdIntInputDto $inputDto): object;
	public function fetchListDysfonctionnementsByLogement(GetByIdIntInputDto $inputDto): object;
	public function fetchListFuitesByLogement(GetByIdIntInputDto $inputDto): object;
	public function fetchListInterventionsByLogement(GetByIdIntInputDto $inputDto): object;
}
