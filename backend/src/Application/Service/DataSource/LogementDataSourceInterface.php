<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Input\Logement\ListInterventionsInputDto;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Input\Logement\ListLeaksInputDto;
use App\Application\Dto\Input\Logement\ListDysfunctionsInputDto;
use App\Application\Dto\Input\Logement\ListAnomaliesInputDto;
use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Input\Logement\ExportInputDto;
use App\Application\Dto\Input\Logement\ExportInterventionsInputDto;
use App\Application\Dto\Input\Logement\ExportLeaksInputDto;
use App\Application\Dto\Input\Logement\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\Logement\ExportAnomaliesInputDto;
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
  public function fetchListInterventions(ListInterventionsInputDto $inputDto): object;
  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object;
  public function fetchListLeaks(ListLeaksInputDto $inputDto): object;
  public function fetchListDysfunctions(ListDysfunctionsInputDto $inputDto): object;
  public function fetchListAnomalies(ListAnomaliesInputDto $inputDto): object;
  public function fetchFilterResult(FilterResultInputDto $inputDto): object;
  public function fetchExport(ExportInputDto $inputDto): object;
  public function fetchExportInterventions(ExportInterventionsInputDto $inputDto): object;
  public function fetchExportLeaks(ExportLeaksInputDto $inputDto): object;
  public function fetchExportDysfunctions(ExportDysfunctionsInputDto $inputDto): object;
  public function fetchExportAnomalies(ExportAnomaliesInputDto $inputDto): object;
  public function fetchEdit(EditInputDto $inputDto): object;
  public function fetchCreateTicket(CreateTicketInputDto $inputDto): object;
  public function fetchCreateTicketImmeuble(CreateTicketImmeubleInputDto $inputDto): object;
  public function fetchGetTicketOnwer(GetTicketOnwerInputDto $inputDto): object;
  public function fetchGuide(GuideInputDto $inputDto): object;
  public function fetchGetInfosAppareil(GetInfosAppareilInputDto $inputDto): object;
  public function fetchShowRepartReleve(ShowRepartReleveInputDto $inputDto): object;
}
