<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Output\Logement\IndexOutputDto;
use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Output\Logement\ShowOutputDto;
use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Output\Logement\SearchOutputDto;
use App\Application\Dto\Input\Logement\ListInterventionsInputDto;
use App\Application\Dto\Output\Logement\ListInterventionsOutputDto;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Output\Logement\ShowInterventionOutputDto;
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
use App\Domain\Service\Soap\LogementSoapInterface;

final class LogementSoap implements LogementSoapInterface
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

  public function searchService(SearchInputDto $inputDto): SearchOutputDto
  {
    // TODO: Implement searchService logic
    return new SearchOutputDto([]);
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

  public function exportService(ExportInputDto $inputDto): ExportOutputDto
  {
    // TODO: Implement exportService logic
    return new ExportOutputDto(true);
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

  public function editService(EditInputDto $inputDto): EditOutputDto
  {
    // TODO: Implement editService logic
    return new EditOutputDto(true);
  }

  public function createTicketService(CreateTicketInputDto $inputDto): CreateTicketOutputDto
  {
    // TODO: Implement createTicketService logic
    return new CreateTicketOutputDto(true);
  }

  public function createTicketImmeubleService(CreateTicketImmeubleInputDto $inputDto): CreateTicketImmeubleOutputDto
  {
    // TODO: Implement createTicketImmeubleService logic
    return new CreateTicketImmeubleOutputDto(true);
  }

  public function getTicketOnwerService(GetTicketOnwerInputDto $inputDto): GetTicketOnwerOutputDto
  {
    // TODO: Implement getTicketOnwerService logic
    return new GetTicketOnwerOutputDto([]);
  }

  public function guideService(GuideInputDto $inputDto): GuideOutputDto
  {
    // TODO: Implement guideService logic
    return new GuideOutputDto([]);
  }

  public function getInfosAppareilService(GetInfosAppareilInputDto $inputDto): GetInfosAppareilOutputDto
  {
    // TODO: Implement getInfosAppareilService logic
    return new GetInfosAppareilOutputDto([]);
  }

  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto
  {
    // TODO: Implement showRepartReleveService logic
    return new ShowRepartReleveOutputDto('', '');
  }
}
