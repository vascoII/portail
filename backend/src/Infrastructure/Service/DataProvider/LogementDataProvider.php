<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\LogementDataProviderInterface;
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
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Redis\RedisService;
use App\Application\Service\DataSource\TicketingDataSourceInterface;
use App\Infrastructure\Transformer\TicketingTransformer;
use App\Application\Service\DataSource\ImmeubleDataSourceInterface;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Application\Service\DataSource\SharedDataSourceInterface;
use App\Infrastructure\Transformer\SharedTransformer;
use App\Application\Service\DataSource\LogementDataSourceInterface;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Application\Service\DataSource\TableauBordClientDataSourceInterface;
use App\Infrastructure\Transformer\TableauBordClientTransformer;

final class LogementDataProvider implements LogementDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private TicketingDataSourceInterface $ticketingDataProvider,
    private TicketingTransformer $ticketingTransformer,
    private ImmeubleDataSourceInterface $immeubleDataSource,
    private ImmeubleTransformer $immeubleTransformer,
    private SharedDataSourceInterface $sharedDataSource,
    private SharedTransformer $sharedTransformer,
    private LogementDataSourceInterface $logementDataSource,
    private LogementTransformer $logementTransformer,
    private TableauBordClientDataSourceInterface $tableauBordClientDataSource,
    private TableauBordClientTransformer $tableauBordClientTransformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(): GetTableauBordClientOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "logement_index:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetTableauBordClientOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->tableauBordClientDataSource->fetcGetTableauBordClient();
    $dto = $this->tableauBordClientTransformer->transformGetTableauBordClient($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function showService(): GetTableauBordClientOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "logement_show:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetTableauBordClientOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->tableauBordClientDataSource->fetcGetTableauBordClient();
    $dto = $this->tableauBordClientTransformer->transformGetTableauBordClient($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listInterventionsService(GetDetailsDepannageInpuDto $inputDto): GetDetailsDepannageOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "logement_list_interventions:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetDetailsDepannageOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->sharedDataSource->fetchGetDetailsDepannage($inputDto);
    $dto = $this->sharedTransformer->transformGetDetailsDepannage($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function showInterventionService(GetDetailsDepannageInpuDto $inputDto): GetDetailsDepannageOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "logement_show_interventions:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetDetailsDepannageOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->sharedDataSource->fetchGetDetailsDepannage($inputDto);
    $dto = $this->sharedTransformer->transformGetDetailsDepannage($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listLeaksService(GetInfosFuitesByImmeubleInputDto $inputDto): GetInfosFuitesByImmeubleOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "logement_list_leaks:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetInfosFuitesByImmeubleOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->immeubleDataSource->fetchGetInfosFuitesByImmeuble($inputDto);
    $dto = $this->immeubleTransformer->transformGetInfosFuitesByImmeuble($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listDysfunctionsService(GetInfosDysfonctionnementsByImmeubleInputDto $inputDto): GetInfosDysfonctionnementsByImmeubleOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "logement_list_dysfuntions:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetInfosDysfonctionnementsByImmeubleOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->immeubleDataSource->fetchGetInfosDysfonctionnementsByImmeuble($inputDto);
    $dto = $this->immeubleTransformer->transformGetInfosDysfonctionnementsByImmeuble($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listAnomaliesService(GetInfosAnomaliesByImmeubleInputDto $inputDto): GetInfosAnomaliesByImmeubleOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "logement_list_anomalies:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetInfosAnomaliesByImmeubleOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->immeubleDataSource->fetchGetInfosAnomaliesByImmeuble($inputDto);
    $dto = $this->immeubleTransformer->transformGetInfosAnomaliesByImmeuble($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function createTicketService(CreateTicketInterInputDto $inputDto): CreateTicketInterOutputDto
  {
    $rawData = $this->ticketingDataProvider->fetchCreateTicketInter($inputDto);
    $dto = $this->ticketingTransformer->transformCreateTicketInter($rawData);

    return $dto;
  }

  public function createTicketImmeubleService(CreateTicketInterInputDto $inputDto): CreateTicketInterOutputDto
  {
    $rawData = $this->ticketingDataProvider->fetchCreateTicketInter($inputDto);
    $dto = $this->ticketingTransformer->transformCreateTicketInter($rawData);

    return $dto;
  }

  public function getTicketOnwerService(GetTicketInterInitInputDto $inputDto): GetTicketInterInitOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "logement_get_ticket_owner:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetTicketInterInitOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->ticketingDataProvider->fetchGetTicketInterInit($inputDto);
    $dto = $this->ticketingTransformer->transformGetTicketInterInit($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function getInfosAppareilService(GetInfosAppareilsByLogementInpuDto $inputDto): GetInfosAppareilsByLogementOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "logement_get_info_appareil:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetInfosAppareilsByLogementOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->logementDataSource->fetchGetInfosAppareilsByLogement($inputDto);
    $dto = $this->logementTransformer->transformGetInfosAppareilsByLogement($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function showRepartReleveService(GetReportInputDto $inputDto): GetReportOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "logement_show_repart_releve:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetReportOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->sharedDataSource->fetchGetReport($inputDto);
    $dto = $this->sharedTransformer->transformGetReport($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
