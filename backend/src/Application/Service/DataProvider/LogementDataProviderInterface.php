<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;
use App\Application\Dto\Input\Shared\GetDetailsDepannageInpuDto;
use App\Application\Dto\Output\Shared\GetDetailsDepannageOutputDto;
use App\Application\Dto\Input\Immeuble\GetInfosFuitesByImmeubleInputDto;
use App\Application\Dto\Output\Immeuble\GetInfosFuitesByImmeubleOutputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDysfonctionnementsByImmeubleInputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDysfonctionnementsByImmeubleOutputDto;
use App\Application\Dto\Input\Immeuble\GetInfosAnomaliesByImmeubleInputDto;
use App\Application\Dto\Output\Immeuble\GetInfosAnomaliesByImmeubleOutputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInterInputDto;
use App\Application\Dto\Output\Ticketing\CreateTicketInterOutputDto;
use App\Application\Dto\Input\Ticketing\GetTicketInterInitInputDto;
use App\Application\Dto\Output\Ticketing\GetTicketInterInitOutputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilsByLogementInpuDto;
use App\Application\Dto\Output\Logement\GetInfosAppareilsByLogementOutputDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;

interface LogementDataProviderInterface
{

  public function indexService(): GetTableauBordClientOutputDto;
  public function showService(): GetTableauBordClientOutputDto;
  public function listInterventionsService(GetDetailsDepannageInpuDto $inputDto): GetDetailsDepannageOutputDto;
  public function showInterventionService(GetDetailsDepannageInpuDto $inputDto): GetDetailsDepannageOutputDto;
  public function listLeaksService(GetInfosFuitesByImmeubleInputDto $inputDto): GetInfosFuitesByImmeubleOutputDto;
  public function listDysfunctionsService(GetInfosDysfonctionnementsByImmeubleInputDto $inputDto): GetInfosDysfonctionnementsByImmeubleOutputDto;
  public function listAnomaliesService(GetInfosAnomaliesByImmeubleInputDto $inputDto): GetInfosAnomaliesByImmeubleOutputDto;
  public function createTicketService(CreateTicketInterInputDto $inputDto): CreateTicketInterOutputDto;
  public function createTicketImmeubleService(CreateTicketInterInputDto $inputDto): CreateTicketInterOutputDto;
  public function getTicketOnwerService(GetTicketInterInitInputDto $inputDto): GetTicketInterInitOutputDto;
  public function getInfosAppareilService(GetInfosAppareilsByLogementInpuDto $inputDto): GetInfosAppareilsByLogementOutputDto;
  public function showRepartReleveService(GetReportInputDto $inputDto): GetReportOutputDto;
}
