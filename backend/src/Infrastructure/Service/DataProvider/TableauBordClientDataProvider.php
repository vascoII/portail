<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\TableauBordClientDataProviderInterface;
use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\TableauBordClientDataSourceInterface;
use App\Application\Service\Transformer\TableauBordClientTransformerInterface;
use App\Application\Service\DataSource\SharedDataSourceInterface;
use App\Application\Service\Transformer\SharedTransformerInterface;
use App\Infrastructure\Service\Redis\RedisService;

final class TableauBordClientDataProvider implements TableauBordClientDataProviderInterface
{
  public function __construct(
    private RedisService $cache,
    private TableauBordClientDataSourceInterface $tableauBordClientDataSource,
    private TableauBordClientTransformerInterface $tableauBordClientTransformer,
    private SharedDataSourceInterface $sharedDataSourceInterface,
    private SharedTransformerInterface $sharedTransformer,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(): GetTableauBordClientOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "tableau_bord_client_index:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetTableauBordClientOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->tableauBordClientDataSource->fetcGetTableauBordClient();
    $dto = $this->tableauBordClientTransformer->transformGetTableauBordClient($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }

  public function interventionService(GetReportInputDto $inputDto): GetReportOutputDto
  {
    $authContext = $this->getAuthContext();
    $cacheKey = "tableau_bord_client_intervention:$authContext->pkUser";
    $cachedDto = $this->cache->get($cacheKey);

    if ($cachedDto instanceof GetReportOutputDto) {
      return $cachedDto;
    }

    $rawData = $this->sharedDataSourceInterface->fetchGetReport($inputDto);
    $dto = $this->sharedTransformer->transformGetReport($rawData);

    $this->cache->set($cacheKey, $dto);

    return $dto;
  }
}
