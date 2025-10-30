<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto ;
use App\Application\Dto\Output\External\GetReportByTokenDataSourceOutputDto;
use App\Application\Service\DataProvider\ExternalDataProviderInterface;
use App\Application\Service\DataSource\ExternalDataSourceInterface;
use App\Application\Service\Transformer\ExternalTransformerInterface;
use App\Infrastructure\Service\Redis\RedisService;

final class ExternalDataProvider implements ExternalDataProviderInterface
{
    public function __construct(
        private RedisService $cache,
        private ExternalDataSourceInterface $externalDataSource,
        private ExternalTransformerInterface $externalTransformer
    ) {}

    public function getReportByTokenService(GetByIdStringInputDto  $inputDto): GetReportByTokenDataSourceOutputDto
    {
        $cacheKey = "report_by_token_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof GetReportByTokenDataSourceOutputDto) {
            return $cachedDto;
        }

        $rawData = $this->externalDataSource->fetchGetReportByToken($inputDto);
        $dto = $this->externalTransformer->transformGetReportByToken($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }
}
