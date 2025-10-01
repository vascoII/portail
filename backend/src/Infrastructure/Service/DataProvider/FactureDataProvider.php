<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\FactureDataProviderInterface;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Facture\IndexOutputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;
use App\Application\Service\DataSource\FactureDataSourceInterface;
use App\Application\Service\DataSource\SharedDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\FactureTransformer;


final class FactureDataProvider implements FactureDataProviderInterface
{
  
  public function __construct(
      private RedisService $cache,
      private FactureDataSourceInterface $factureDataSource,
      private SharedDataSourceInterface $sharedDataSource,
      private readonly FactureTransformer $transformer,
      private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(): IndexOutputDto
  {  
      $authContext = $this->getAuthContext();

      $cacheKey = "facture_index:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof IndexOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->factureDataSource->fetchGetFactures();
      $dto = $this->transformer->transformIndex($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function reportService(GetReportInputDto $inputDto): ReportOutputDto
  {
      $authContext = $this->getAuthContext();

      $cacheKey = "facture_report:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ReportOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->sharedDataSource->fetchGetReport($inputDto);
      $dto = $this->transformer->transformReport($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

}
