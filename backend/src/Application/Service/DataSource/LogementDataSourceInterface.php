<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Logement\GetImmeubleIdAndLogementIdInputDto;

interface LogementDataSourceInterface
{

	public function fetchGetLogements(GetByIdIntInputDto $inputDto): object;
	public function fetchGetLogement(GetByIdIntInputDto $inputDto): object;
	public function fetchGetLogementCapteur(GetByIdIntInputDto $inputDto): object;
	public function fetchGetLogementCET(GetByIdIntInputDto $inputDto): object;
	public function fetchGetLogementEC(GetByIdIntInputDto $inputDto): object;
	public function fetchGetLogementEF(GetByIdIntInputDto $inputDto): object;
	public function fetchGetLogementElect(GetByIdIntInputDto $inputDto): object;
	public function fetchGetLogementGaz(GetByIdIntInputDto $inputDto): object;
	public function fetchGetLogementRepart(GetByIdIntInputDto $inputDto): object;
	public function fetchListAnomaliesByLogement(GetImmeubleIdAndLogementIdInputDto $inputDto): object;
	public function fetchListDysfonctionnementsByLogement(GetByIdIntInputDto $inputDto): object;
	public function fetchListFuitesByLogement(GetByIdIntInputDto $inputDto): object;
	public function fetchListInterventionsByLogement(GetByIdIntInputDto $inputDto): object;
}
