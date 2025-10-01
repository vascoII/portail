<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\ReportTokenDataProviderInterface;
use App\Application\Dto\Input\ReportToken\ReportInputDto;
use App\Application\Dto\Output\ReportToken\ReportOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\ReportTokenDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\ReportTokenTransformer;

final class ReportTokenDataProvider implements ReportTokenDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private ReportTokenDataSourceInterface $source,
    private ReportTokenTransformer $transformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function reportService(ReportInputDto $inputDto): ReportOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "report_token_report:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof ReportOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->source->fetchReport($inputDto);
    $dto = $this->transformer->transformReport($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
