<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

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

interface LogementSoapInterface
{

  public function indexService(IndexInputDto $inputDto): array;
  public function showService(ShowInputDto $inputDto): array;
  public function searchService(SearchInputDto $inputDto): array;
  public function listInterventionsService(ListInterventionsInputDto $inputDto): array;
  public function showInterventionService(ShowInterventionInputDto $inputDto): array;
  public function listLeaksService(ListLeaksInputDto $inputDto): array;
  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): array;
  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): array;
  public function filterResultService(FilterResultInputDto $inputDto): array;
  public function exportService(ExportInputDto $inputDto): array;
  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): array;
  public function exportLeaksService(ExportLeaksInputDto $inputDto): array;
  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): array;
  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): array;
  public function editService(EditInputDto $inputDto): array;
  public function createTicketService(CreateTicketInputDto $inputDto): array;
  public function createTicketImmeubleService(CreateTicketImmeubleInputDto $inputDto): array;
  public function getTicketOnwerService(GetTicketOnwerInputDto $inputDto): array;
  public function guideService(GuideInputDto $inputDto): array;
  public function getInfosAppareilService(GetInfosAppareilInputDto $inputDto): array;
  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): array;
}
