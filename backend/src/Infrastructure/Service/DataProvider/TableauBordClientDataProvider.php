<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\TableauBordClientDataProviderInterface;
use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Output\TableauBordClient\IndexOutputDto;
use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\TableauBordClientDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\TableauBordClientTransformer;

final class TableauBordClientDataProvider implements TableauBordClientDataProviderInterface
{
  public function __construct(
    private RedisCacheService $cache,
    private TableauBordClientDataSourceInterface $source,
    private TableauBordClientTransformer $transformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "tableau_bord_client_index:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof IndexOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->source->fetchIndex($inputDto);
    $dto = $this->transformer->transformIndex($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function interventionService(InterventionInputDto $inputDto): InterventionOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "tableau_bord_client_intervention:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof InterventionOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->source->fetchIntervention($inputDto);
    $dto = $this->transformer->transformIntervention($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
