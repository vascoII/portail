<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;
use App\Application\Dto\Output\Immeuble\ListLogementsOuputDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;

use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\ImmeubleDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Application\Service\Transformer\ImmeubleTransformerInterface;
use App\Application\Service\Transformer\SharedTransformerInterface;

final class ImmeubleDataProvider implements ImmeubleDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private ImmeubleDataSourceInterface $immeubleDataSource,
    private ImmeubleTransformerInterface $immeubleTransformer,
    private SharedTransformerInterface $sharedTransformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function listImmeublesService(): ListImmeublesOutputDto
  {
    $authContext = $this->getAuthContext();

    $cacheKey = "immeuble_list:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListImmeublesOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->immeubleDataSource->fetchGetImmeubles();
    $dto = $this->immeubleTransformer->transformListImmeubles($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listImmeublesIndicatorsService(): ListIndicatorsOuputDto
  {
      $authContext = $this->getAuthContext();

      $cacheKey = "immeuble_indicators_list:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListIndicatorsOuputDto) {
        return $cachedDto;
      }

      $rawData = $this->immeubleDataSource->fetchGetImmeublesIndicators();
      $dto = $this->sharedTransformer->transformListImmeublesIndicators($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  public function getImmeubleService(GetByIdIntInputDto $inputDto): GetImmeubleOutputDto
  {
    $cacheKey = "immeuble_get:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetImmeubleOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->immeubleDataSource->fetchGetImmeuble($inputDto);
    $dto = $this->immeubleTransformer->transformGetImmeuble($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listAnomaliesByImmeubleService(GetByIdIntInputDto $inputDto): ListAnomaliesOuputDto
  {
    $cacheKey = "immeuble_anomalies_list:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListAnomaliesOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->immeubleDataSource->fetchListAnomaliesByImmeuble($inputDto);
    $dto = $this->sharedTransformer->transformListAnomalies($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listDysfonctionnementsByImmeubleService(GetByIdIntInputDto $inputDto): ListDysfonctionnementsOuputDto
  {
    $cacheKey = "immeuble__dysfonctionnements_list:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListDysfonctionnementsOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->immeubleDataSource->fetchListDysfonctionnementsByImmeuble($inputDto);
    $dto = $this->sharedTransformer->transformListDysfonctionnements($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listFuitesByImmeubleService(GetByIdIntInputDto $inputDto): ListFuitesOuputDto
  {
    $cacheKey = "immeuble_fuites_list:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListFuitesOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->immeubleDataSource->fetchListFuitesByImmeuble($inputDto);
    $dto = $this->sharedTransformer->transformListFuites($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listInterventionsByImmeubleService(GetByIdIntInputDto $inputDto): ListInternetionsOutputDto
  {
    $cacheKey = "immeuble_interventions_list:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListInternetionsOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->immeubleDataSource->fetchListInterventionsByImmeuble($inputDto);
    $dto = $this->sharedTransformer->transformListInterventions($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function listLogementsByImmeubleService(GetByIdIntInputDto $inputDto): ListLogementsOuputDto
  {
    $cacheKey = "immeuble_ligements_list:$inputDto->id";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ListLogementsOuputDto) {
      return $cachedDto;
    }

    $rawData = $this->immeubleDataSource->fetchListLogementsByImmeuble($inputDto);
    $dto = $this->immeubleTransformer->transformListLogementsByImmeuble($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
