<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\GestionParc\IndexOutputDto;
use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Output\GestionParc\InterventionOutputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Output\GestionParc\ReportOutputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Output\GestionParc\ShowOutputDto;
use App\Application\Dto\Input\GestionParc\InterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ListInterventionsOutputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Output\GestionParc\ShowInterventionOutputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Output\GestionParc\FilterResultOutputDto;
use App\Application\Dto\Input\GestionParc\LeaksInputDto;
use App\Application\Dto\Output\GestionParc\ListLeaksOutputDto;
use App\Application\Dto\Input\GestionParc\AnomaliesInputDto;
use App\Application\Dto\Output\GestionParc\ListAnomaliesOutputDto;
use App\Application\Dto\Input\GestionParc\DysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ListDysfunctionsOutputDto;

interface GestionParcDataProviderInterface
{

  public function indexService(): IndexOutputDto;
  public function interventionService(InterventionInputDto $inputDto): InterventionOutputDto;
  public function reportService(ReportInputDto $inputDto): ReportOutputDto;
  public function showService(ShowInputDto $inputDto): ShowOutputDto;
  public function listInterventionsService(InterventionsInputDto $inputDto): ListInterventionsOutputDto;
  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto;
  public function filterResultService(FilterResultInputDto $inputDto): FilterResultOutputDto;
  public function listLeaksService(LeaksInputDto $inputDto): ListLeaksOutputDto;
  public function listAnomaliesService(AnomaliesInputDto $inputDto): ListAnomaliesOutputDto;
  public function listDysfunctionsService(DysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto;
}
