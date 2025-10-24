<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Output\Logement\ListLogementsOuputDto;
use App\Application\Dto\Output\Logement\LogementOutputDto;
use App\Application\Dto\Output\Shared\ListAnomaliesOuputDto;
use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Dto\Output\Shared\ListIndicatorsOuputDto;
use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataProvider\LogementDataProviderInterface;
use App\Application\Service\DataSource\LogementDataSourceInterface;
use App\Application\Service\Transformer\LogementTransformerInterface;
use App\Application\Service\Transformer\SharedTransformerInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Redis\RedisService;

final class LogementDataProvider implements LogementDataProviderInterface
{
    public function __construct(
        private RedisService $cache,
        private LogementDataSourceInterface $logementDataSource,
        private LogementTransformerInterface $logementTransformer,
        private SharedTransformerInterface $sharedTransformer,
        private readonly AuthServiceInterface $authService
    ) {}

    public function getLogementCapteurService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "logement_capteur_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchGetLogementCapteur($inputDto);
        $dto = $this->sharedTransformer->transformGetLogementCapteur($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getLogementCETService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "logement_cet_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchGetLogementCET($inputDto);
        $dto = $this->sharedTransformer->transformGetLogementCET($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getLogementECService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "logement_ec_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchGetLogementEC($inputDto);
        $dto = $this->sharedTransformer->transformGetLogementEC($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getLogementEFService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "logement_ef_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchGetLogementEF($inputDto);
        $dto = $this->sharedTransformer->transformGetLogementEF($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getLogementElectService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "logement_elect_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchGetLogementElect($inputDto);
        $dto = $this->sharedTransformer->transformGetLogementElect($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getLogementGazService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "logement_gaz_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchGetLogementGaz($inputDto);
        $dto = $this->sharedTransformer->transformGetLogementGaz($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getLogementIndicatorsService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "logement_indicators_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchGetLogement($inputDto);
        $dto = $this->sharedTransformer->transformGetLogementIndicators($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getLogementRepartService(GetByIdIntInputDto $inputDto): ListIndicatorsOuputDto
    {
        $cacheKey = "logement_repart_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListIndicatorsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchGetLogementRepart($inputDto);
        $dto = $this->sharedTransformer->transformGetLogementRepart($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function getLogementService(GetByIdIntInputDto $inputDto): LogementOutputDto
    {
        $cacheKey = "logement_get:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof LogementOutputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchGetLogement($inputDto);
        $dto = $this->logementTransformer->transformGetLogement($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listAnomaliesByLogementService(GetByIdIntInputDto $inputDto): ListAnomaliesOuputDto
    {
        $cacheKey = "logement_anomalies_list:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListAnomaliesOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchListAnomaliesByLogement($inputDto);
        $dto = $this->sharedTransformer->transformListAnomalies($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listDysfonctionnementsByLogementService(GetByIdIntInputDto $inputDto): ListDysfonctionnementsOuputDto
    {
        $cacheKey = "logement__dysfonctionnements_list:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListDysfonctionnementsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchListDysfonctionnementsByLogement($inputDto);
        dd($rawData);
        $dto = $this->sharedTransformer->transformListDysfonctionnements($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listFuitesByLogementService(GetByIdIntInputDto $inputDto): ListFuitesOuputDto
    {
        $cacheKey = "logement_fuites_list:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListFuitesOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchListFuitesByLogement($inputDto);
        $dto = $this->sharedTransformer->transformListFuites($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listInterventionsByLogementService(GetByIdIntInputDto $inputDto): ListInternetionsOutputDto
    {
        $cacheKey = "logement_interventions_list:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListInternetionsOutputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchListInterventionsByLogement($inputDto);
        $dto = $this->sharedTransformer->transformListInterventions($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    public function listLogementsService(GetByIdIntInputDto $inputDto): ListLogementsOuputDto
    {
        $cacheKey = "logement_list:{$inputDto->id}";
        $cachedDto = $this->cache->get($cacheKey);

        if ($cachedDto instanceof ListLogementsOuputDto) {
            return $cachedDto;
        }

        $rawData = $this->logementDataSource->fetchGetLogements($inputDto);
        $dto = $this->logementTransformer->transformListLogements($rawData);

        $this->cache->set($cacheKey, $dto);

        return $dto;
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
