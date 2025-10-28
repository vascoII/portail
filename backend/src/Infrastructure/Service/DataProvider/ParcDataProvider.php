<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Output\Parc\GetParcOutputDto;
use App\Application\Service\DataProvider\ParcDataProviderInterface;
use App\Application\Service\DataSource\ParcDataSourceInterface;
use App\Application\Service\Transformer\ParcTransformerInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Redis\RedisService;
final class ParcDataProvider implements ParcDataProviderInterface
{
    public function __construct(
        private RedisService $cache,
        private readonly ParcDataSourceInterface $dataSource,
        private readonly ParcTransformerInterface $transformer,
        private readonly AuthServiceInterface $authService
    ) {}

    public function getParcService(): GetParcOutputDto
    {
        $authContext = $this->getAuthContext();

        $cacheKey = "parc:{$authContext->pkUser}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof GetParcOutputDto) {
            return $cachedDto;
        }

        $rawData = $this->dataSource->fetchGetParc();
        $dto = $this->transformer->transformGetParc($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
