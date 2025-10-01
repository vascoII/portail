<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\InterventionDataProviderInterface;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Intervention\ReportOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\SharedDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\InterventionTransformer;

final class InterventionDataProvider implements InterventionDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private SharedDataSourceInterface $sharedDataSource,
    private InterventionTransformer $transformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function reportService(GetReportInputDto $inputDto): ReportOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "intervention_report:$authContext->pkUser";
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
