<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

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

interface ImmeubleSoapInterface
{

  public function indexService(IndexInputDto $inputDto): array;
  public function showService(ShowInputDto $inputDto): array;
  public function reportService(ReportInputDto $inputDto): array;
  public function listInterventionsService(ListInterventionsInputDto $inputDto): array;
  public function showInterventionService(ShowInterventionInputDto $inputDto): array;
  public function interventionService(InterventionInputDto $inputDto): array;
  public function listLeaksService(ListLeaksInputDto $inputDto): array;
  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): array;
  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): array;
  public function filterResultService(FilterResultInputDto $inputDto): array;
  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): array;
  public function exportLeaksService(ExportLeaksInputDto $inputDto): array;
  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): array;
  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): array;
}
