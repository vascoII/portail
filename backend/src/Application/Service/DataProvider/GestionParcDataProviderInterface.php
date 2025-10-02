<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Input\GestionParc\InterventionsInputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Input\GestionParc\DysfunctionsInputDto;
use App\Application\Dto\Input\GestionParc\AnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\LeaksInputDto;
use App\Application\Dto\Output\Immeuble\GetTableauBordImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDepannagesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosFuitesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosAnomaliesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDysfonctionnementsByImmeubleOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;

interface GestionParcDataProviderInterface
{

  public function indexService(): GetTableauBordClientOutputDto;
  public function interventionService(InterventionInputDto $inputDto): GetReportOutputDto;
  public function reportService(ReportInputDto $inputDto): GetReportOutputDto;
  public function showService(ShowInputDto $inputDto): GetTableauBordImmeubleOutputDto;
  public function listInterventionsService(InterventionsInputDto $inputDto): GetInfosDepannagesByImmeubleOutputDto;
  public function showInterventionService(ShowInterventionInputDto $inputDto): GetInfosDepannagesByImmeubleOutputDto;
  public function filterResultService(FilterResultInputDto $inputDto): GetInfosImmeublesOutputDto;
  public function listLeaksService(LeaksInputDto $inputDto): GetInfosFuitesByImmeubleOutputDto;
  public function listAnomaliesService(AnomaliesInputDto $inputDto): GetInfosAnomaliesByImmeubleOutputDto;
  public function listDysfunctionsService(DysfunctionsInputDto $inputDto): GetInfosDysfonctionnementsByImmeubleOutputDto;
}
