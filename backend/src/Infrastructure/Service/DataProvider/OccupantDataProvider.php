<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Service\DataProvider\OccupantDataProviderInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Service\DataSource\LogementDataSourceInterface;
use App\Application\Service\DataSource\SharedDataSourceInterface;
use App\Application\Service\DataSource\ImmeubleDataSourceInterface;
use App\Infrastructure\Service\Redis\RedisService;
use App\Application\Service\Transformer\OccupantTransformerInterface;

final class OccupantDataProvider implements OccupantDataProviderInterface
{
  public function __construct(
      private RedisService $cache,
      private LogementDataSourceInterface $logementDataSource,
      private SharedDataSourceInterface $sharedDataSource,
      private ImmeubleDataSourceInterface $immeubleDataSource,
      private OccupantTransformerInterface $transformer,
      private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function alertesService()
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
  
  public function listDysfunctionsService( $inputDto)
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
  
  public function listInterventionsService( $inputDto)
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
  
  public function listLeaksService( $inputDto)
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
  
  public function myAccountService( $inputDto)
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
  
  public function showEauReleveService( $inputDto)
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
  
  public function showInterventionService( $inputDto)
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
  
  public function showNoteReleveService( $inputDto)
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
  
  public function showRepartReleveService( $inputDto)
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
  
  public function showService( $inputDto)
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
  
  public function simulateurService( $inputDto)
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
  
  public function editService( $inputDto)
  {
      $authContext = $this->getAuthContext();
      $rawData = $this->source->fetchEdit($inputDto);
      $dto = $this->transformer->transformEdit($rawData);

      return $dto;
  }
  
}
