<?php

declare(strict_types=1);

namespace App\Domain\Service\DataProvider;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Output\Logement\IndexOutputDto;
use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Output\Logement\ShowOutputDto;
use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Output\Logement\SearchOutputDto;
use App\Application\Dto\Input\Logement\ListInterventionsInputDto;
use App\Application\Dto\Output\Logement\ListInterventionsOutputDto;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Output\Logement\ShowIntervenTionOutputDto;
use App\Application\Dto\Input\Logement\ListLeaksInputDto;
use App\Application\Dto\Output\Logement\ListLeaksOutputDto;
use App\Application\Dto\Input\Logement\ListDysfunctionsInputDto;
use App\Application\Dto\Output\Logement\ListDysfunctionsOutputDto;
use App\Application\Dto\Input\Logement\ListAnomaliesInputDto;
use App\Application\Dto\Output\Logement\ListAnomaliesOutputDto;
use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Output\Logement\FilterResultOutputDto;
use App\Application\Dto\Input\Logement\ExportInputDto;
use App\Application\Dto\Output\Logement\ExportOutputDto;
use App\Application\Dto\Input\Logement\ExportInterventionsInputDto;
use App\Application\Dto\Output\Logement\ExportInterventionsOutputDto;
use App\Application\Dto\Input\Logement\ExportLeaksInputDto;
use App\Application\Dto\Output\Logement\ExportLeaksOutputDto;
use App\Application\Dto\Input\Logement\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Logement\ExportDysfunctionsOutputDto;
use App\Application\Dto\Input\Logement\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Logement\ExportAnomaliesOutputDto;
use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Output\Logement\EditOutputDto;
use App\Application\Dto\Input\Logement\CreateTicketInputDto;
use App\Application\Dto\Output\Logement\CreateTicketOutputDto;
use App\Application\Dto\Input\Logement\CreateTicketImmeubleInputDto;
use App\Application\Dto\Output\Logement\CreateTicketImmeubleOutputDto;
use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Output\Logement\GetTicketOnwerOutputDto;
use App\Application\Dto\Input\Logement\GuideInputDto;
use App\Application\Dto\Output\Logement\GuideOutputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use App\Application\Dto\Output\Logement\GetInfosAppareilOutputDto;
use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Logement\ShowRepartReleveOutputDto;

interface LogementInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
  public function showService(ShowInputDto $inputDto): ShowOutputDto;
  public function searchService(SearchInputDto $inputDto): SearchOutputDto;
  public function listInterventionsService(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto;
  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto;
  public function listLeaksService(ListLeaksInputDto $inputDto): ListLeaksOutputDto;
  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto;
  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto;
  public function filterResultService(FilterResultInputDto $inputDto): FilterResultOutputDto;
  public function exportService(ExportInputDto $inputDto): ExportOutputDto;
  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto;
  public function exportLeaksService(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto;
  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto;
  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto;
  public function editService(EditInputDto $inputDto): EditOutputDto;
  public function createTicketService(CreateTicketInputDto $inputDto): CreateTicketOutputDto;
  public function createTicketImmeubleService(CreateTicketImmeubleInputDto $inputDto): CreateTicketImmeubleOutputDto;
  public function getTicketOnwerService(GetTicketOnwerInputDto $inputDto): GetTicketOnwerOutputDto;
  public function guideService(GuideInputDto $inputDto): GuideOutputDto;
  public function getInfosAppareilService(GetInfosAppareilInputDto $inputDto): GetInfosAppareilOutputDto;
  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto;
}
