<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Immeuble\GetTableauBordImmeubleInputDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Input\Shared\GetDetailsDepannageInpuDto;
use App\Application\Dto\Input\Immeuble\GetInfosFuitesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDysfonctionnementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosAnomaliesByImmeubleInputDto;
use App\Application\Dto\Output\Immeuble\GetTableauBordImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDepannagesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosFuitesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosAnomaliesByImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\GetInfosDysfonctionnementsByImmeubleOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDepannagesByImmeubleInputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\ImmeubleDataSourceInterface;
use App\Application\Service\DataSource\SharedDataSourceInterface;
use App\Application\Service\DataSource\TableauBordClientDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Infrastructure\Transformer\SharedTransformer;
use App\Infrastructure\Transformer\TableauBordClientTransformer;

final class ImmeubleDataProvider implements ImmeubleDataProviderInterface
{
  public function __construct(
      private RedisService $cache,
      private ImmeubleDataSourceInterface $immeubleDataSource,
      private ImmeubleTransformer $immeubleTransformer,
      private SharedDataSourceInterface $sharedDataSource,
      private SharedTransformer $sharedTransformer,
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
      $cacheKey = "immeuble_index:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof GetTableauBordClientOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->tableauBordClientDataSource->fetcGetTableauBordClient();
      $dto = $this->tableauBordClientTransformer->transformGetTableauBordClient($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function showService(GetTableauBordImmeubleInputDto $inputDto): GetTableauBordImmeubleOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "immeuble_show:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof GetTableauBordImmeubleOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->immeubleDataSource->fetchGetTableauBordImmeuble($inputDto);
      $dto = $this->immeubleTransformer->transformGetTableauBordImmeuble($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function reportService(GetReportInputDto $inputDto): GetReportOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "immeuble_report:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof GetReportOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->sharedDataSource->fetchGetReport($inputDto);
      $dto = $this->sharedTransformer->transformGetReport($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function listInterventionsService(GetInfosDepannagesByImmeubleInputDto $inputDto): GetInfosDepannagesByImmeubleOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "immeuble_list_interventions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof GetInfosDepannagesByImmeubleOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->immeubleDataSource->fetchGetInfosDepannagesByImmeuble($inputDto);
      $dto = $this->immeubleTransformer->transformGetInfosDepannagesByImmeuble($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function showInterventionService(GetInfosDepannagesByImmeubleInputDto $inputDto): GetInfosDepannagesByImmeubleOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "immeuble_show_interventions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof GetInfosDepannagesByImmeubleOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->immeubleDataSource->fetchGetInfosDepannagesByImmeuble($inputDto);
      $dto = $this->immeubleTransformer->transformGetInfosDepannagesByImmeuble($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function listLeaksService(GetInfosFuitesByImmeubleInputDto $inputDto): GetInfosFuitesByImmeubleOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "immeuble_list_leaks:$authContext->pkUser";
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
      $cacheKey = "immeuble_list_dysfunctions:$authContext->pkUser";
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
      $cacheKey = "immeuble_list_anomalies:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof GetInfosAnomaliesByImmeubleOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->immeubleDataSource->fetchGetInfosAnomaliesByImmeuble($inputDto);
      $dto = $this->immeubleTransformer->transformGetInfosAnomaliesByImmeuble($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
}
