<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\GestionParc\IndexInputDto;
use App\Application\Dto\Output\GestionParc\IndexOutputDto;
use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Output\GestionParc\InterventionOutputDto;
use App\Application\Dto\Input\GestionParc\ExportInterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ExportInterventionsOutputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Output\GestionParc\ReportOutputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Output\GestionParc\ShowOutputDto;
use App\Application\Dto\Input\GestionParc\ExportLeaksInputDto;
use App\Application\Dto\Output\GestionParc\ExportLeaksOutputDto;
use App\Application\Dto\Input\GestionParc\ExportAnomaliesInputDto;
use App\Application\Dto\Output\GestionParc\ExportAnomaliesOutputDto;
use App\Application\Dto\Input\GestionParc\ListInterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ListInterventionsOutputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Output\GestionParc\ShowInterventionOutputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Output\GestionParc\FilterResultOutputDto;
use App\Application\Dto\Input\GestionParc\ListLeaksInputDto;
use App\Application\Dto\Output\GestionParc\ListLeaksOutputDto;
use App\Application\Dto\Input\GestionParc\ListAnomaliesInputDto;
use App\Application\Dto\Output\GestionParc\ListAnomaliesOutputDto;
use App\Application\Dto\Input\GestionParc\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ExportDysfunctionsOutputDto;
use App\Application\Dto\Input\GestionParc\ListDysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ListDysfunctionsOutputDto;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class GestionParcSoap implements GestionParcSoapInterface
{
  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
    // TODO: Implement indexService logic
    return new IndexOutputDto([]);
  }

  public function interventionService(InterventionInputDto $inputDto): InterventionOutputDto
  {
    // TODO: Implement interventionService logic
    return new InterventionOutputDto([]);
  }

  public function reportService(ReportInputDto $inputDto): ReportOutputDto
  {
    // TODO: Implement reportService logic
    return new ReportOutputDto(true);
  }

  public function showService(ShowInputDto $inputDto): ShowOutputDto
  {
    // TODO: Implement showService logic
    return new ShowOutputDto([]);
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

  public function filterResultService(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    // TODO: Implement filterResultService logic
    return new FilterResultOutputDto([]);
  }

  public function listLeaksService(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    // TODO: Implement listLeaksService logic
    return new ListLeaksOutputDto([]);
  }

  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    // TODO: Implement listAnomaliesService logic
    return new ListAnomaliesOutputDto([]);
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

  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    // TODO: Implement exportAnomaliesService logic
    return new ExportAnomaliesOutputDto(true);
  }

  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    // TODO: Implement exportDysfunctionsService logic
    return new ExportDysfunctionsOutputDto(true);
  }

  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    // TODO: Implement listDysfunctionsService logic
    return new ListDysfunctionsOutputDto([]);
  }
}
