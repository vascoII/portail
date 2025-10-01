<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\SearchDataProviderInterface;
use App\Application\Dto\Input\Search\IndexInputDto;
use App\Application\Dto\Output\Search\IndexOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\SearchDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\SearchTransformer;

final class SearchDataProvider implements SearchDataProviderInterface
{
  public function __construct(
    private RedisCacheService $cache,
    private SearchDataSourceInterface $source,
    private SearchTransformer $transformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "search_index:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof IndexOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->source->fetchIndex($inputDto);
    $dto = $this->transformer->transformIndex($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
