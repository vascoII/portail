<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Output\Logement\ListLogementsOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Logement\GetLogementOutputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;
use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Logement\ListLogementsOuputDto;

use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\LogementDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Application\Service\Transformer\LogementTransformerInterface;
use App\Application\Service\Transformer\SharedTransformerInterface;

final class LogementDataProvider implements LogementDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private LogementDataSourceInterface $logementDataSource,
    private LogementTransformerInterface $logementTransformer,
    private SharedTransformerInterface $sharedTransformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function listLogementsService(GetByIdIntInputDto $inputDto): ListLogementsOutputDto
  {
    $authContext = $this->getAuthContext();

    $cacheKey = "logement_list:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListLogementsOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->logementDataSource->fetchGetLogements($inputDto);
    $dto = $this->logementTransformer->transformListLogements($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function getLogementService(GetByIdIntInputDto $inputDto): GetLogementOutputDto
  {
    $cacheKey = "logement_get:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetLogementOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->logementDataSource->fetchGetLogement($inputDto);
    $dto = $this->logementTransformer->transformGetLogement($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listAnomaliesByLogementService(GetByIdIntInputDto $inputDto): ListAnomaliesOuputDto
  {
    $cacheKey = "logement_anomalies_list:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListAnomaliesOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->logementDataSource->fetchListAnomaliesByLogement($inputDto);
    $dto = $this->sharedTransformer->transformListAnomalies($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listDysfonctionnementsByLogementService(GetByIdIntInputDto $inputDto): ListDysfonctionnementsOuputDto
  {
    $cacheKey = "logement__dysfonctionnements_list:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListDysfonctionnementsOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->logementDataSource->fetchListDysfonctionnementsByLogement($inputDto);
    $dto = $this->sharedTransformer->transformListDysfonctionnements($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listFuitesByLogementService(GetByIdIntInputDto $inputDto): ListFuitesOuputDto
  {
    $cacheKey = "logement_fuites_list:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListFuitesOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->logementDataSource->fetchListFuitesByLogement($inputDto);
    $dto = $this->sharedTransformer->transformListFuites($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listInterventionsByLogementService(GetByIdIntInputDto $inputDto): ListInternetionsOutputDto
  {
    $cacheKey = "logement_interventions_list:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListInternetionsOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->logementDataSource->fetchListInterventionsByLogement($inputDto);
    $dto = $this->sharedTransformer->transformListInterventions($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
