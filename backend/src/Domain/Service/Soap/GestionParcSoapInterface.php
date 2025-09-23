<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

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

interface GestionParcSoapInterface
{

  public function indexService(IndexInputDto $inputDto): array;
  public function interventionService(InterventionInputDto $inputDto): array;
  public function reportService(ReportInputDto $inputDto): array;
  public function showService(ShowInputDto $inputDto): array;
  public function listInterventionsService(ListInterventionsInputDto $inputDto): array;
  public function showInterventionService(ShowInterventionInputDto $inputDto): array;
  public function filterResultService(FilterResultInputDto $inputDto): array;
  public function listLeaksService(ListLeaksInputDto $inputDto): array;
  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): array;
  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): array;
  public function exportLeaksService(ExportLeaksInputDto $inputDto): array;
  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): array;
  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): array;
  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): array;
}
