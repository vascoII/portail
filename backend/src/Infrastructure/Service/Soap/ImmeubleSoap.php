<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

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
use App\Application\Dto\Input\Immeuble\LinterventionInputDto;
use App\Application\Dto\Output\Immeuble\LinterventionOutputDto;
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
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ImmeubleSoap implements ImmeubleSoapInterface
{
  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
    // TODO: Implement indexService logic
    return new IndexOutputDto([]);
  }

  public function showService(ShowInputDto $inputDto): ShowOutputDto
  {
    // TODO: Implement showService logic
    return new ShowOutputDto([]);
  }

  public function reportService(ReportInputDto $inputDto): ReportOutputDto
  {
    // TODO: Implement reportService logic
    return new ReportOutputDto(true);
  }

  public function listInterventionsService(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    // TODO: Implement listInterventionsService logic
    return new ListInterventionsOutputDto([]);
  }

  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    // TODO: Implement showInterventionService logic
    return new ShowInterventionOutputDto([]);
  }

  public function linterventionService(LinterventionInputDto $inputDto): LinterventionOutputDto
  {
    // TODO: Implement linterventionService logic
    return new LinterventionOutputDto([]);
  }

  public function listLeaksService(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    // TODO: Implement listLeaksService logic
    return new ListLeaksOutputDto([]);
  }

  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    // TODO: Implement listDysfunctionsService logic
    return new ListDysfunctionsOutputDto([]);
  }

  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    // TODO: Implement listAnomaliesService logic
    return new ListAnomaliesOutputDto([]);
  }

  public function filterResultService(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    // TODO: Implement filterResultService logic
    return new FilterResultOutputDto([]);
  }

  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    // TODO: Implement exportInterventionsService logic
    return new ExportInterventionsOutputDto(true);
  }

  public function exportLeaksService(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    // TODO: Implement exportLeaksService logic
    return new ExportLeaksOutputDto(true);
  }

  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    // TODO: Implement exportDysfunctionsService logic
    return new ExportDysfunctionsOutputDto(true);
  }

  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    // TODO: Implement exportAnomaliesService logic
    return new ExportAnomaliesOutputDto(true);
  }
}
