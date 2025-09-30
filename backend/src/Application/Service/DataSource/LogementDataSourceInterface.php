<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Input\Logement\InterventionsInputDto;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Input\Logement\LeaksInputDto;
use App\Application\Dto\Input\Logement\DysfunctionsInputDto;
use App\Application\Dto\Input\Logement\AnomaliesInputDto;
use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Input\Logement\CreateTicketInputDto;
use App\Application\Dto\Input\Logement\CreateTicketImmeubleInputDto;
use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Input\Logement\GuideInputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;

interface LogementDataSourceInterface
{

  public function fetchIndex(IndexInputDto $inputDto): object;
  public function fetchShow(ShowInputDto $inputDto): object;
  public function fetchSearch(SearchInputDto $inputDto): object;
  public function fetchListInterventions(InterventionsInputDto $inputDto): object;
  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object;
  public function fetchListLeaks(LeaksInputDto $inputDto): object;
  public function fetchListDysfunctions(DysfunctionsInputDto $inputDto): object;
  public function fetchListAnomalies(AnomaliesInputDto $inputDto): object;
  public function fetchFilterResult(FilterResultInputDto $inputDto): object;
  public function fetchEdit(EditInputDto $inputDto): object;
  public function fetchCreateTicket(CreateTicketInputDto $inputDto): object;
  public function fetchCreateTicketImmeuble(CreateTicketImmeubleInputDto $inputDto): object;
  public function fetchGetTicketOnwer(GetTicketOnwerInputDto $inputDto): object;
  public function fetchGuide(GuideInputDto $inputDto): object;
  public function fetchGetInfosAppareil(GetInfosAppareilInputDto $inputDto): object;
  public function fetchShowRepartReleve(ShowRepartReleveInputDto $inputDto): object;
}
