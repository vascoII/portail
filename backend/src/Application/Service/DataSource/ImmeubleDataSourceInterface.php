<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

interface ImmeubleDataSourceInterface
{

    public function fetchGetImmeubles(): object;

    public function fetchGetImmeuble(GetByIdIntInputDto $inputDto): object;
    public function fetchGetImmeubleCapteur(GetByIdIntInputDto $inputDto): object;
    public function fetchGetImmeubleCET(GetByIdIntInputDto $inputDto): object;
    public function fetchGetImmeubleEC(GetByIdIntInputDto $inputDto): object;
    public function fetchGetImmeubleEF(GetByIdIntInputDto $inputDto): object;
    public function fetchGetImmeubleRepart(GetByIdIntInputDto $inputDto): object;
    public function fetchGetImmeubleSerieConsosEAU(GetByIdIntInputDto $inputDto): object;


    public function fetchListAnomaliesByImmeuble(GetByIdIntInputDto $inputDto): object;
    public function fetchListDysfonctionnementsByImmeuble(GetByIdIntInputDto $inputDto): object;
    public function fetchListFuitesByImmeuble(GetByIdIntInputDto $inputDto): object;
    public function fetchListInterventionsByImmeuble(GetByIdIntInputDto $inputDto): object;
    public function fetchListLogementsByImmeuble(GetByIdIntInputDto $inputDto): object;
}
