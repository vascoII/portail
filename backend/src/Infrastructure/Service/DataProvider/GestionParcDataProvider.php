<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\GestionParcDataProviderInterface;
use App\Application\Dto\Output\GestionParc\IndexOutputDto;
use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Output\GestionParc\InterventionOutputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Output\GestionParc\ReportOutputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Output\GestionParc\ShowOutputDto;
use App\Application\Dto\Input\GestionParc\InterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ListInterventionsOutputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Output\GestionParc\ShowInterventionOutputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Output\GestionParc\FilterResultOutputDto;
use App\Application\Dto\Input\GestionParc\LeaksInputDto;
use App\Application\Dto\Output\GestionParc\ListLeaksOutputDto;
use App\Application\Dto\Input\GestionParc\AnomaliesInputDto;
use App\Application\Dto\Output\GestionParc\ListAnomaliesOutputDto;
use App\Application\Dto\Input\GestionParc\DysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ListDysfunctionsOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\GestionParcDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\GestionParcTransformer;

final class GestionParcDataProvider implements GestionParcDataProviderInterface
{
  public function __construct(
      private RedisService $cache,
      private GestionParcDataSourceInterface $source,
      private GestionParcTransformer $transformer,
      private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(): IndexOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "gestion_parc_index:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof IndexOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchIndex();
      $dto = $this->transformer->transformIndex($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function interventionService(InterventionInputDto $inputDto): InterventionOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "gestion_parc_interventions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof InterventionOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchIntervention($inputDto);
      $dto = $this->transformer->transformIntervention($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function reportService(ReportInputDto $inputDto): ReportOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "gestion_parc_report:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ReportOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchReport($inputDto);
      $dto = $this->transformer->transformReport($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function showService(ShowInputDto $inputDto): ShowOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "gestion_parc_show:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ShowOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchShow($inputDto);
      $dto = $this->transformer->transformShow($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function listInterventionsService(InterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "gestion_parc_list_interventions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListInterventionsOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchListInterventions($inputDto);
      $dto = $this->transformer->transformListInterventions($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "gestion_parc_show_interventions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ShowInterventionOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchShowIntervention($inputDto);
      $dto = $this->transformer->transformShowIntervention($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function filterResultService(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "gestion_parc_filter_result:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof FilterResultOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchFilterResult($inputDto);
      $dto = $this->transformer->transformFilterResult($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function listLeaksService(LeaksInputDto $inputDto): ListLeaksOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "gestion_parc__list_leaks:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListLeaksOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchListLeaks($inputDto);
      $dto = $this->transformer->transformListLeaks($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function listAnomaliesService(AnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "gestion_parc_list_anomalies:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListAnomaliesOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchListAnomalies($inputDto);
      $dto = $this->transformer->transformListAnomalies($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }

  public function listDysfunctionsService(DysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "gestion_parc_list_dysfunctions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListDysfunctionsOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchListDysfunctions($inputDto);
      $dto = $this->transformer->transformListDysfunctions($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
}
