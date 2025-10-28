<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Output\Logement\ListLogementsOuputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListFuitesOutputDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;
use App\Application\Dto\Output\Shared\ListInterventionsOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;
use App\Application\Service\DataSource\ImmeubleDataSourceInterface;
use App\Application\Service\Transformer\ImmeubleTransformerInterface;
use App\Application\Service\Transformer\LogementTransformerInterface;
use App\Application\Service\Transformer\SharedTransformerInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Redis\RedisService;

final class ImmeubleDataProvider implements ImmeubleDataProviderInterface
{
    public function __construct(
        private RedisService $cache,
        private ImmeubleDataSourceInterface $immeubleDataSource,
        private ImmeubleTransformerInterface $immeubleTransformer,
        private LogementTransformerInterface $logementTransformer,
        private SharedTransformerInterface $sharedTransformer,
        private readonly AuthServiceInterface $authService
    ) {}

    public function getImmeubleCapteurService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "immeuble_capteur_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchGetImmeubleCapteur($inputDto);
        $dto = $this->immeubleTransformer->transformGetImmeubleCapteur($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getImmeubleCETService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "immeuble_cet_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchGetImmeubleCET($inputDto);
        $dto = $this->immeubleTransformer->transformGetImmeubleCET($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getImmeubleECService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "immeuble_ec_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchGetImmeubleEC($inputDto);
        $dto = $this->immeubleTransformer->transformGetImmeubleEC($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getImmeubleEFService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "immeuble_ef_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchGetImmeubleEF($inputDto);
        $dto = $this->immeubleTransformer->transformGetImmeubleEF($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getImmeubleRepartService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "immeuble_repart_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchGetImmeubleRepart($inputDto);
        $dto = $this->immeubleTransformer->transformGetImmeubleRepart($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getImmeubleSerieConsosEAUService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "immeuble_serie_consos_eau_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchGetImmeubleSerieConsosEAU($inputDto);
        $dto = $this->immeubleTransformer->transformGetImmeubleSerieConsosEAU($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getImmeubleService(GetByIdIntInputDto $inputDto): GetImmeubleOutputDto
    {
        $cacheKey = "immeuble_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof GetImmeubleOutputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchGetImmeuble($inputDto);
        $dto = $this->immeubleTransformer->transformGetImmeuble($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listAnomaliesByImmeubleService(GetByIdIntInputDto $inputDto): ListAnomaliesOuputDto
    {
        $cacheKey = "immeuble_anomalies_list:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListAnomaliesOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchListAnomaliesByImmeuble($inputDto);
        $dto = $this->sharedTransformer->transformListAnomalies($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listDysfonctionnementsByImmeubleService(GetByIdIntInputDto $inputDto): ListDysfonctionnementsOuputDto
    {
        $cacheKey = "immeuble_dysfonctionnements_list:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListDysfonctionnementsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchListDysfonctionnementsByImmeuble($inputDto); 
        $dto = $this->sharedTransformer->transformListDysfonctionnements($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listFuitesByImmeubleService(GetByIdIntInputDto $inputDto): ListFuitesOutputDto
    {
        $cacheKey = "immeuble_fuites_list:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListFuitesOutputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchListFuitesByImmeuble($inputDto);
        $dto = $this->sharedTransformer->transformListFuites($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listImmeublesService(): ListImmeublesOutputDto
    {
        $authContext = $this->getAuthContext();

        $cacheKey = "immeuble_list:{$authContext->pkUser}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListImmeublesOutputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchGetImmeubles();
        $dto = $this->immeubleTransformer->transformListImmeubles($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listInterventionsByImmeubleService(GetByIdIntInputDto $inputDto): ListInterventionsOutputDto
    {
        $cacheKey = "immeuble_interventions_list:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListInterventionsOutputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchListInterventionsByImmeuble($inputDto);
        $dto = $this->sharedTransformer->transformListInterventions($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listLogementsByImmeubleService(GetByIdIntInputDto $inputDto): ListLogementsOuputDto
    {
        $cacheKey = "immeuble_logements_list:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListLogementsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->immeubleDataSource->fetchListLogementsByImmeuble($inputDto);
        $dto = $this->logementTransformer->transformListLogements($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
