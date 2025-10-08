<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Service\DataProvider\InterventionDataProviderInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\SharedDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Application\Service\Transformer\SharedTransformerInterface;

final class InterventionDataProvider implements InterventionDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private SharedDataSourceInterface $sharedDataSource,
    private readonly SharedTransformerInterface $transformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function generateInterventionPdfService(GetReportInputDto $inputDto): GetReportOutputDto
  {
    $filename = 'releve-intervention-' . date('Y-m-d') . '.pdf';

    $authContext = $this->getAuthContext();
    $cacheKey = "intervention_generate:$authContext->pkUser:$inputDto->params";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetReportOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->sharedDataSource->fetchGetReport($inputDto);
    $dto = $this->transformer->transformGetReport($rawData, $filename);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
