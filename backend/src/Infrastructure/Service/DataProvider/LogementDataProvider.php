<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\LogementDataProviderInterface;
use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Output\Logement\IndexOutputDto;
use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Output\Logement\ShowOutputDto;
use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Output\Logement\SearchOutputDto;
use App\Application\Dto\Input\Logement\ListInterventionsInputDto;
use App\Application\Dto\Output\Logement\ListInterventionsOutputDto;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Output\Logement\ShowIntervenTionOutputDto;
use App\Application\Dto\Input\Logement\ListLeaksInputDto;
use App\Application\Dto\Output\Logement\ListLeaksOutputDto;
use App\Application\Dto\Input\Logement\ListDysfunctionsInputDto;
use App\Application\Dto\Output\Logement\ListDysfunctionsOutputDto;
use App\Application\Dto\Input\Logement\ListAnomaliesInputDto;
use App\Application\Dto\Output\Logement\ListAnomaliesOutputDto;
use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Output\Logement\FilterResultOutputDto;
use App\Application\Dto\Input\Logement\ExportInputDto;
use App\Application\Dto\Output\Logement\ExportOutputDto;
use App\Application\Dto\Input\Logement\ExportInterventionsInputDto;
use App\Application\Dto\Output\Logement\ExportInterventionsOutputDto;
use App\Application\Dto\Input\Logement\ExportLeaksInputDto;
use App\Application\Dto\Output\Logement\ExportLeaksOutputDto;
use App\Application\Dto\Input\Logement\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Logement\ExportDysfunctionsOutputDto;
use App\Application\Dto\Input\Logement\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Logement\ExportAnomaliesOutputDto;
use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Output\Logement\EditOutputDto;
use App\Application\Dto\Input\Logement\CreateTicketInputDto;
use App\Application\Dto\Output\Logement\CreateTicketOutputDto;
use App\Application\Dto\Input\Logement\CreateTicketImmeubleInputDto;
use App\Application\Dto\Output\Logement\CreateTicketImmeubleOutputDto;
use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Output\Logement\GetTicketOnwerOutputDto;
use App\Application\Dto\Input\Logement\GuideInputDto;
use App\Application\Dto\Output\Logement\GuideOutputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use App\Application\Dto\Output\Logement\GetInfosAppareilOutputDto;
use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Logement\ShowRepartReleveOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\LogementDataSourceInterface;
use App\Infrastructure\Service\Cache\RedisCacheService;
use App\Infrastructure\Transformer\LogementTransformer;

final class LogementDataProvider implements LogementDataProviderInterface
{
  public function __construct(
      private RedisCacheService $cache,
      private LogementDataSourceInterface $source,
      private LogementTransformer $transformer,
      private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_index:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof IndexOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchIndex($inputDto);
      $dto = $this->transformer->transformIndex($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function showService(ShowInputDto $inputDto): ShowOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_show:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ShowOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchShow($inputDto);
      $dto = $this->transformer->transformShow($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function searchService(SearchInputDto $inputDto): SearchOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_search:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof SearchOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchSearch($inputDto);
      $dto = $this->transformer->transformSearch($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function listInterventionsService(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_list_interventions:$authContext->pkUser";
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
      $cacheKey = "logement_show_interventions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ShowInterventionOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchShowIntervention($inputDto);
      $dto = $this->transformer->transformShowIntervention($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function listLeaksService(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_list_leaks:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListLeaksOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchListLeaks($inputDto);
      $dto = $this->transformer->transformListLeaks($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_list_dysfuntions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListDysfunctionsOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchListDysfunctions($inputDto);
      $dto = $this->transformer->transformListDysfunctions($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_list_anomalies:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListAnomaliesOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchListAnomalies($inputDto);
      $dto = $this->transformer->transformListAnomalies($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function filterResultService(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_filter_result:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof FilterResultOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchFilterResult($inputDto);
      $dto = $this->transformer->transformFilterResult($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function exportService(ExportInputDto $inputDto): ExportOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_export:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ExportOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchExport($inputDto);
      $dto = $this->transformer->transformExport($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_export_interventions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ExportInterventionsOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchExportInterventions($inputDto);
      $dto = $this->transformer->transformExportInterventions($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function exportLeaksService(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_export_leaks:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ExportLeaksOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchExportLeaks($inputDto);
      $dto = $this->transformer->transformExportLeaks($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_export_dysfunctions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ExportDysfunctionsOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchExportDysfunctions($inputDto);
      $dto = $this->transformer->transformExportDysfunctions($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_export_anomalies:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ExportAnomaliesOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchExportAnomalies($inputDto);
      $dto = $this->transformer->transformExportAnomalies($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function editService(EditInputDto $inputDto): EditOutputDto
  {
      $rawData = $this->source->fetchEdit($inputDto);
      $dto = $this->transformer->transformEdit($rawData);

      return $dto;
  }
  
  public function createTicketService(CreateTicketInputDto $inputDto): CreateTicketOutputDto
  {
      $rawData = $this->source->fetchCreateTicket($inputDto);
      $dto = $this->transformer->transformCreateTicket($rawData);

      return $dto;
  }
  
  public function createTicketImmeubleService(CreateTicketImmeubleInputDto $inputDto): CreateTicketImmeubleOutputDto
  {
      $rawData = $this->source->fetchCreateTicketImmeuble($inputDto);
      $dto = $this->transformer->transformCreateTicketImmeuble($rawData);

      return $dto;
  }
  
  public function getTicketOnwerService(GetTicketOnwerInputDto $inputDto): GetTicketOnwerOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_get_ticket_owner:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof GetTicketOnwerOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchGetTicketOnwer($inputDto);
      $dto = $this->transformer->transformGetTicketOnwer($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function guideService(GuideInputDto $inputDto): GuideOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_guide:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof GuideOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchGuide($inputDto);
      $dto = $this->transformer->transformGuide($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function getInfosAppareilService(GetInfosAppareilInputDto $inputDto): GetInfosAppareilOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_get_info_appareil:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof GetInfosAppareilOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchGetInfosAppareil($inputDto);
      $dto = $this->transformer->transformGetInfosAppareil($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "logement_show_repart_releve:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ShowRepartReleveOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchShowRepartReleve($inputDto);
      $dto = $this->transformer->transformShowRepartReleve($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
}
