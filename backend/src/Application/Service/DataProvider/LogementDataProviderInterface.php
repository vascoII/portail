<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Output\Logement\IndexOutputDto;
use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Output\Logement\ShowOutputDto;
use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Output\Logement\SearchOutputDto;
use App\Application\Dto\Input\Logement\InterventionsInputDto;
use App\Application\Dto\Output\Logement\ListInterventionsOutputDto;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Output\Logement\ShowInterventionOutputDto;
use App\Application\Dto\Input\Logement\LeaksInputDto;
use App\Application\Dto\Output\Logement\ListLeaksOutputDto;
use App\Application\Dto\Input\Logement\DysfunctionsInputDto;
use App\Application\Dto\Output\Logement\ListDysfunctionsOutputDto;
use App\Application\Dto\Input\Logement\AnomaliesInputDto;
use App\Application\Dto\Output\Logement\ListAnomaliesOutputDto;
use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Output\Logement\FilterResultOutputDto;
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

interface LogementDataProviderInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
  public function showService(ShowInputDto $inputDto): ShowOutputDto;
  public function searchService(SearchInputDto $inputDto): SearchOutputDto;
  public function listInterventionsService(InterventionsInputDto $inputDto): ListInterventionsOutputDto;
  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto;
  public function listLeaksService(LeaksInputDto $inputDto): ListLeaksOutputDto;
  public function listDysfunctionsService(DysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto;
  public function listAnomaliesService(AnomaliesInputDto $inputDto): ListAnomaliesOutputDto;
  public function filterResultService(FilterResultInputDto $inputDto): FilterResultOutputDto;
  public function editService(EditInputDto $inputDto): EditOutputDto;
  public function createTicketService(CreateTicketInputDto $inputDto): CreateTicketOutputDto;
  public function createTicketImmeubleService(CreateTicketImmeubleInputDto $inputDto): CreateTicketImmeubleOutputDto;
  public function getTicketOnwerService(GetTicketOnwerInputDto $inputDto): GetTicketOnwerOutputDto;
  public function guideService(GuideInputDto $inputDto): GuideOutputDto;
  public function getInfosAppareilService(GetInfosAppareilInputDto $inputDto): GetInfosAppareilOutputDto;
  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto;
}
