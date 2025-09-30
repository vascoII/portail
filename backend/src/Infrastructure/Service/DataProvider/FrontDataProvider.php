<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\FrontDataProviderInterface;
use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Output\Front\IndexOutputDto;
use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Output\Front\CguOutputDto;
use App\Application\Dto\Output\Front\PersonalDatasOutputDto;
use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use App\Application\Dto\Output\Front\LegalNoticesOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\FrontDataSourceInterface;
use App\Infrastructure\Service\Cache\RedisCacheService;
use App\Infrastructure\Transformer\FrontTransformer;

final class FrontDataProvider implements FrontDataProviderInterface
{
  public function __construct(
      private RedisCacheService $cache,
      private FrontDataSourceInterface $source,
      private FrontTransformer $transformer,
      private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "front_index:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof IndexOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchIndex($inputDto);
      $dto = $this->transformer->transformIndex($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function cguService(CguInputDto $inputDto): CguOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "front_cgu:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof CguOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchCgu($inputDto);
      $dto = $this->transformer->transformCgu($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function personalDatasService(): PersonalDatasOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "front_personal_data:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof PersonalDatasOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchPersonalDatas();
      $dto = $this->transformer->transformPersonalData($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function legalNoticesService(LegalNoticesInputDto $inputDto): LegalNoticesOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "front_legal_notice:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof LegalNoticesOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchLegalNotices($inputDto);
      $dto = $this->transformer->transformLegalNotices($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
}
