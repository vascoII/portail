<?php

declare(strict_types=1);

namespace App\Application\Service;

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
use App\Domain\Service\DataProvider\GestionParcInterface;

final class GestionParcService implements GestionParcInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {

  }
  
  public function interventionService(InterventionInputDto $inputDto): InterventionOutputDto
  {

  }

  public function reportService(ReportInputDto $inputDto): ReportOutputDto
  {

  }

  public function showService(ShowInputDto $inputDto): ShowOutputDto
  {

  }

  public function listInterventionsService(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {

  }

  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {

  }

  public function filterResultService(FilterResultInputDto $inputDto): FilterResultOutputDto
  {

  }

  public function listLeaksService(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {

  }

  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {

  }

  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {

  }

  public function exportLeaksService(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {

  }

  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {

  }

  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {

  }

  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {

  }

}
