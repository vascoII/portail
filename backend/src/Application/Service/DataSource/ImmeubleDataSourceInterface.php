<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Immeuble\GetTableauBordImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosAnomaliesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosLogementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDepannagesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDysfonctionnementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosFuitesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosImmeublesInputDto;

interface ImmeubleDataSourceInterface
{

//  public function fetchIndex(IndexInputDto $inputDto): object;
//  public function fetchShow(ShowInputDto $inputDto): object;
//  public function fetchReport(ReportInputDto $inputDto): object;
//  public function fetchListInterventions(InterventionsInputDto $inputDto): object;
//  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object;
//  public function fetchIntervention(InterventionInputDto $inputDto): object;
//  public function fetchListLeaks(LeaksInputDto $inputDto): object;
//  public function fetchListDysfunctions(DysfunctionsInputDto $inputDto): object;
//  public function fetchListAnomalies(AnomaliesInputDto $inputDto): object;
//  public function fetchFilterResult(FilterResultInputDto $inputDto): object;

    public function fetchGetTableauBordImmeuble(GetTableauBordImmeubleInputDto $inputDto): object;
    public function fetchGetInfosAnomaliesByImmeuble(GetInfosAnomaliesByImmeubleInputDto $inputDto): object;
    public function fetchGetInfosLogementsByImmeuble(GetInfosLogementsByImmeubleInputDto $inputDto): object;
    public function fetchGetInfosDepannagesByImmeuble(GetInfosDepannagesByImmeubleInputDto $inputDto): object;
    public function fetchGetInfosDysfonctionnementsByImmeuble(GetInfosDysfonctionnementsByImmeubleInputDto $inputDto): object;
    public function fetchGetInfosFuitesByImmeuble(GetInfosFuitesByImmeubleInputDto $inputDto): object;
    public function fetchGetInfosImmeubles(GetInfosImmeublesInputDto $inputDto): object;
}
