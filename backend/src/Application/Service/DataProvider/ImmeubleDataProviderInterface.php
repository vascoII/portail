<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Output\Immeuble\IndexOutputDto;
use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Output\Immeuble\ShowOutputDto;
use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Output\Immeuble\ReportOutputDto;
use App\Application\Dto\Input\Immeuble\ListInterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ListInterventionsOutputDto;
use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Output\Immeuble\ShowInterventionOutputDto;
use App\Application\Dto\Input\Immeuble\InterventionInputDto;
use App\Application\Dto\Output\Immeuble\InterventionOutputDto;
use App\Application\Dto\Input\Immeuble\ListLeaksInputDto;
use App\Application\Dto\Output\Immeuble\ListLeaksOutputDto;
use App\Application\Dto\Input\Immeuble\ListDysfunctionsInputDto;
use App\Application\Dto\Output\Immeuble\ListDysfunctionsOutputDto;
use App\Application\Dto\Input\Immeuble\ListAnomaliesInputDto;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOutputDto;
use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use App\Application\Dto\Output\Immeuble\FilterResultOutputDto;
use App\Application\Dto\Input\Immeuble\ExportInterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ExportInterventionsOutputDto;
use App\Application\Dto\Input\Immeuble\ExportLeaksInputDto;
use App\Application\Dto\Output\Immeuble\ExportLeaksOutputDto;
use App\Application\Dto\Input\Immeuble\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Immeuble\ExportDysfunctionsOutputDto;
use App\Application\Dto\Input\Immeuble\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Immeuble\ExportAnomaliesOutputDto;

interface ImmeubleDataProviderInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
  public function showService(ShowInputDto $inputDto): ShowOutputDto;
  public function reportService(ReportInputDto $inputDto): ReportOutputDto;
  public function listInterventionsService(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto;
  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto;
  public function interventionService(InterventionInputDto $inputDto): InterventionOutputDto;
  public function listLeaksService(ListLeaksInputDto $inputDto): ListLeaksOutputDto;
  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto;
  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto;
  public function filterResultService(FilterResultInputDto $inputDto): FilterResultOutputDto;
  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto;
  public function exportLeaksService(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto;
  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto;
  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto;
}
