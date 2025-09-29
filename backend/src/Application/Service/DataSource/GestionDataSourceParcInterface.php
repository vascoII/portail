<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\GestionParc\IndexInputDto;
use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Input\GestionParc\ExportInterventionsInputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Input\GestionParc\ExportLeaksInputDto;
use App\Application\Dto\Input\GestionParc\ExportAnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\ListInterventionsInputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Input\GestionParc\ListLeaksInputDto;
use App\Application\Dto\Input\GestionParc\ListAnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\GestionParc\ListDysfunctionsInputDto;

interface GestionParcDataSourceInterface
{

  public function fetchIndex(IndexInputDto $inputDto): object;
  public function fetchIntervention(InterventionInputDto $inputDto): object;
  public function fetchReport(ReportInputDto $inputDto): object;
  public function fetchShow(ShowInputDto $inputDto): object;
  public function fetchListInterventions(ListInterventionsInputDto $inputDto): object;
  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object;
  public function fetchFilterResult(FilterResultInputDto $inputDto): object;
  public function fetchListLeaks(ListLeaksInputDto $inputDto): object;
  public function fetchListAnomalies(ListAnomaliesInputDto $inputDto): object;
  public function fetchExportInterventions(ExportInterventionsInputDto $inputDto): object;
  public function fetchExportLeaks(ExportLeaksInputDto $inputDto): object;
  public function fetchExportAnomalies(ExportAnomaliesInputDto $inputDto): object;
  public function fetchExportDysfunctions(ExportDysfunctionsInputDto $inputDto): object;
  public function fetchListDysfunctions(ListDysfunctionsInputDto $inputDto): object;
}
