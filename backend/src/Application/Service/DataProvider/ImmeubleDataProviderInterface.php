<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Output\Immeuble\IndexOutputDto;
use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Output\Immeuble\ShowOutputDto;
use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Output\Immeuble\ReportOutputDto;
use App\Application\Dto\Input\Immeuble\InterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ListInterventionsOutputDto;
use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Output\Immeuble\ShowInterventionOutputDto;
use App\Application\Dto\Input\Immeuble\InterventionInputDto;
use App\Application\Dto\Output\Immeuble\InterventionOutputDto;
use App\Application\Dto\Input\Immeuble\LeaksInputDto;
use App\Application\Dto\Output\Immeuble\ListLeaksOutputDto;
use App\Application\Dto\Input\Immeuble\DysfunctionsInputDto;
use App\Application\Dto\Output\Immeuble\ListDysfunctionsOutputDto;
use App\Application\Dto\Input\Immeuble\AnomaliesInputDto;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOutputDto;
use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use App\Application\Dto\Output\Immeuble\FilterResultOutputDto;
interface ImmeubleDataProviderInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
  public function showService(ShowInputDto $inputDto): ShowOutputDto;
  public function reportService(ReportInputDto $inputDto): ReportOutputDto;
  public function listInterventionsService(InterventionsInputDto $inputDto): ListInterventionsOutputDto;
  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto;
  public function interventionService(InterventionInputDto $inputDto): InterventionOutputDto;
  public function listLeaksService(LeaksInputDto $inputDto): ListLeaksOutputDto;
  public function listDysfunctionsService(DysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto;
  public function listAnomaliesService(AnomaliesInputDto $inputDto): ListAnomaliesOutputDto;
  public function filterResultService(FilterResultInputDto $inputDto): FilterResultOutputDto;
}
