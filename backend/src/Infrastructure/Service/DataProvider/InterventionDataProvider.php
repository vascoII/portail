<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Intervention\GetCasesByEmailInpuDto;
use App\Application\Dto\Output\Intervention\ListCasesOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataProvider\InterventionDataProviderInterface;
use App\Application\Service\DataSource\InterventionDataSourceInterface;
use App\Application\Service\Transformer\InterventionTransformerInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Redis\RedisService;

final class InterventionDataProvider implements InterventionDataProviderInterface
{
    public function __construct(
        private RedisService $cache,
        private InterventionDataSourceInterface $interventionDataSource,
        private readonly InterventionTransformerInterface $transformer,
        private readonly AuthServiceInterface $authService
    ) {}

    public function listCasesService(GetCasesByEmailInpuDto $inputDto): ListCasesOutputDto
    {
        $filename = 'releve-intervention-' . date('Y-m-d') . '.pdf';

        $authContext = $this->getAuthContext();
        $cacheKey = "intervention_generate:{$authContext->pkUser}:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListCasesOutputDto) {
            return $cachedDto;
        }

        $rawData = $this->interventionDataSource->fetchGetCases($inputDto);
        $dto = $this->transformer->transformGetCases($rawData, $filename);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
