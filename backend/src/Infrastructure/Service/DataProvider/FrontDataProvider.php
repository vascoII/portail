<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\FrontDataProviderInterface;
use App\Application\Dto\Output\Admin\ListSousTraitantOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\AdminDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\FrontTransformer;

final class FrontDataProvider implements FrontDataProviderInterface
{
  public function __construct(
      private RedisService $cache,
      private AdminDataSourceInterface $source,
      private FrontTransformer $transformer,
      private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function personalDatasService(): ListSousTraitantOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "front_personal_data:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListSousTraitantOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchGetSousTraitants();
      $dto = $this->transformer->transformPersonalData($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

}
