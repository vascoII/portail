<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\OccupantDataProviderInterface;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Occupant\GetOccupantOutputDto;
use App\Application\Dto\Output\Occupant\GetOccupantAccountOutputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;
use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListAlertesOuputDto;

use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\OccupantDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Application\Service\Transformer\OccupantTransformerInterface;
use App\Application\Service\Transformer\SharedTransformerInterface;

final class OccupantDataProvider implements OccupantDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private OccupantDataSourceInterface $occupantDataSource,
    private OccupantTransformerInterface $occupantTransformer,
    private SharedTransformerInterface $sharedTransformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function getOccupantService(): GetOccupantOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "occupant_get:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetOccupantOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->occupantDataSource->fetchGetOccupant();
    $dto = $this->occupantTransformer->transformGetOccupant($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listAlertesByOccupantService(): ListAlertesOuputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "occupant_alertes_list:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListAlertesOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->occupantDataSource->fetchListAlertesByOccupant();
    $dto = $this->sharedTransformer->transformListAlertes($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listAnomaliesByOccupantService(): ListAnomaliesOuputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "occupant_anomalies_list:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListAnomaliesOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->occupantDataSource->fetchListAnomaliesByOccupant();
    $dto = $this->sharedTransformer->transformListAnomalies($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listDysfonctionnementsByOccupantService(): ListDysfonctionnementsOuputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "occupant__dysfonctionnements_list:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListDysfonctionnementsOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->occupantDataSource->fetchListDysfonctionnementsByOccupant();
    $dto = $this->sharedTransformer->transformListDysfonctionnements($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listFuitesByOccupantService(): ListFuitesOuputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "occupant_fuites_list:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListFuitesOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->occupantDataSource->fetchListFuitesByOccupant();
    $dto = $this->sharedTransformer->transformListFuites($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listInterventionsByOccupantService(): ListInternetionsOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "occupant_interventions_list:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListInternetionsOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->occupantDataSource->fetchListInterventionsByOccupant();
    $dto = $this->sharedTransformer->transformListInterventions($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function getOccupantAccountService(): GetOccupantAccountOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "occupant_account_get:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetOccupantAccountOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->occupantDataSource->fetchGetOccupantAccount();
    $dto = $this->occupantTransformer->transformGetOccupantAccount($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
