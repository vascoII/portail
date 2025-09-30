<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\OccupantDataProviderInterface;
use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Output\Occupant\AlertesOutputDto;
use App\Application\Dto\Input\Occupant\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Occupant\ExportAnomaliesOutputDto;
use App\Application\Dto\Input\Occupant\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\ExportDysfunctionsOutputDto;
use App\Application\Dto\Input\Occupant\ExportInterventionsInputDto;
use App\Application\Dto\Output\Occupant\ExportInterventionsOutputDto;
use App\Application\Dto\Input\Occupant\ExportLeaksInputDto;
use App\Application\Dto\Output\Occupant\ExportLeaksOutputDto;
use App\Application\Dto\Input\Occupant\AnomaliesInputDto;
use App\Application\Dto\Output\Occupant\ListAnomaliesOutputDto;
use App\Application\Dto\Input\Occupant\DysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\ListDysfunctionsOutputDto;
use App\Application\Dto\Input\Occupant\InterventionsInputDto;
use App\Application\Dto\Output\Occupant\ListInterventionsOutputDto;
use App\Application\Dto\Input\Occupant\LeaksInputDto;
use App\Application\Dto\Output\Occupant\ListLeaksOutputDto;
use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Output\Occupant\MyAccountOutputDto;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowEauReleveOutputDto;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Output\Occupant\ShowInterventionOutputDto;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowNoteReleveOutputDto;
use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowRepartReleveOutputDto;
use App\Application\Dto\Input\Occupant\ShowInputDto;
use App\Application\Dto\Output\Occupant\ShowOutputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Application\Dto\Output\Occupant\SimulateurOutputDto;
use App\Application\Dto\Input\Occupant\EditInputDto;
use App\Application\Dto\Output\Occupant\EditOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\OccupantDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Infrastructure\Transformer\OccupantTransformer;

final class OccupantDataProvider implements OccupantDataProviderInterface
{
  public function __construct(
      private RedisService $cache,
      private OccupantDataSourceInterface $source,
      private OccupantTransformer $transformer,
      private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function alertesService(AlertesInputDto $inputDto): AlertesOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_alertes:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof AlertesOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchAlertes($inputDto);
      $dto = $this->transformer->transformAlertes($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function listAnomaliesService(AnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_list_anomalies:$authContext->pkUser";
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
      $cacheKey = "occupant_list_dysfunctions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListDysfunctionsOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchListDysfunctions($inputDto);
      $dto = $this->transformer->transformListDysfunctions($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function listInterventionsService(InterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_list_interventions:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListInterventionsOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchListInterventions($inputDto);
      $dto = $this->transformer->transformListInterventions($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function listLeaksService(LeaksInputDto $inputDto): ListLeaksOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_list_leaks:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ListLeaksOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchListLeaks($inputDto);
      $dto = $this->transformer->transformListLeaks($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function myAccountService(MyAccountInputDto $inputDto): MyAccountOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_my_account:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof MyAccountOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchMyAccount($inputDto);
      $dto = $this->transformer->transformMyAccount($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function showEauReleveService(ShowEauReleveInputDto $inputDto): ShowEauReleveOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_show_eau_releve:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ShowEauReleveOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchShowEauReleve($inputDto);
      $dto = $this->transformer->transformShowEauReleve($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_show_intervention:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ShowInterventionOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchShowIntervention($inputDto);
      $dto = $this->transformer->transformShowIntervention($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function showNoteReleveService(ShowNoteReleveInputDto $inputDto): ShowNoteReleveOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_show_note-releve:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ShowNoteReleveOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchShowNoteReleve($inputDto);
      $dto = $this->transformer->transformShowNoteReleve($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_show_repart_releve:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ShowRepartReleveOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchShowRepartReleve($inputDto);
      $dto = $this->transformer->transformShowRepartReleve($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function showService(ShowInputDto $inputDto): ShowOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_show:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof ShowOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchShow($inputDto);
      $dto = $this->transformer->transformShow($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function simulateurService(SimulateurInputDto $inputDto): SimulateurOutputDto
  {
      $authContext = $this->getAuthContext();
      $cacheKey = "occupant_simulateur:$authContext->pkUser";
      $cachedDto = $this->cache->get($cacheKey);

      if ($cachedDto instanceof SimulateurOutputDto) {
        return $cachedDto;
      }

      $rawData = $this->source->fetchSimulateur($inputDto);
      $dto = $this->transformer->transformSimulateur($rawData);

      $this->cache->set($cacheKey, $dto);

      return $dto;
  }
  
  public function editService(EditInputDto $inputDto): EditOutputDto
  {
      $authContext = $this->getAuthContext();
      $rawData = $this->source->fetchEdit($inputDto);
      $dto = $this->transformer->transformEdit($rawData);

      return $dto;
  }
  
}
