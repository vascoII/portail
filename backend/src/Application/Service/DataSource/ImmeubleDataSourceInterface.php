<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Input\Immeuble\ListInterventionsInputDto;
use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Input\Immeuble\InterventionInputDto;
use App\Application\Dto\Input\Immeuble\ListLeaksInputDto;
use App\Application\Dto\Input\Immeuble\ListDysfunctionsInputDto;
use App\Application\Dto\Input\Immeuble\ListAnomaliesInputDto;
use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use App\Application\Dto\Input\Immeuble\ExportInterventionsInputDto;
use App\Application\Dto\Input\Immeuble\ExportLeaksInputDto;
use App\Application\Dto\Input\Immeuble\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\Immeuble\ExportAnomaliesInputDto;

interface ImmeubleDataSourceInterface
{

  public function fetchIndex(IndexInputDto $inputDto): object;
  public function fetchShow(ShowInputDto $inputDto): object;
  public function fetchReport(ReportInputDto $inputDto): object;
  public function fetchListInterventions(ListInterventionsInputDto $inputDto): object;
  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object;
  public function fetchIntervention(InterventionInputDto $inputDto): object;
  public function fetchListLeaks(ListLeaksInputDto $inputDto): object;
  public function fetchListDysfunctions(ListDysfunctionsInputDto $inputDto): object;
  public function fetchListAnomalies(ListAnomaliesInputDto $inputDto): object;
  public function fetchFilterResult(FilterResultInputDto $inputDto): object;
  public function fetchExportInterventions(ExportInterventionsInputDto $inputDto): object;
  public function fetchExportLeaks(ExportLeaksInputDto $inputDto): object;
  public function fetchExportDysfunctions(ExportDysfunctionsInputDto $inputDto): object;
  public function fetchExportAnomalies(ExportAnomaliesInputDto $inputDto): object;
}
