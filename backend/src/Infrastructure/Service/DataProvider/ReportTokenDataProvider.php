<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\ReportTokenDataProviderInterface;
use App\Application\Dto\Input\Shared\GetReportByTokenInputDto;
use App\Application\Dto\Output\Shared\GetReportByTokenOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\SharedDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\SharedTransformer;

final class ReportTokenDataProvider implements ReportTokenDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private SharedDataSourceInterface $sharedDataSource,
    private SharedTransformer $sharedTransformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function reportService(GetReportByTokenInputDto $inputDto): GetReportByTokenOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "report_token_report:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetReportByTokenOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->sharedDataSource->fetchGetReportByToken($inputDto);
    $dto = $this->sharedTransformer->transformGetReportByToken($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
