<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataSource\ImmeubleDataSourceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Hydrator\ImmeubleHydrator;

final class ImmeubleSoap extends Soap implements ImmeubleDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly ImmeubleHydrator $hydrator,
        private readonly AuthServiceInterface $authService
    ) {
        parent::__construct($soapClient);
    }

    public function fetchGetImmeuble(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetImmeuble($inputDto);

        return $this->safeCall('GetTableauBordImmeuble', $soapRequest);
    }

    public function fetchGetImmeubleCapteur(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetImmeuble($inputDto);

        return $this->safeCall('GetTableauBordImmeuble', $soapRequest);
    }

    public function fetchGetImmeubleCET(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetImmeuble($inputDto);

        return $this->safeCall('GetTableauBordImmeuble', $soapRequest);
    }

    public function fetchGetImmeubleEC(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetImmeuble($inputDto);

        return $this->safeCall('GetTableauBordImmeuble', $soapRequest);
    }

    public function fetchGetImmeubleEF(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetImmeuble($inputDto);

        return $this->safeCall('GetTableauBordImmeuble', $soapRequest);
    }

    public function fetchGetImmeubleRepart(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetImmeuble($inputDto);

        return $this->safeCall('GetTableauBordImmeuble', $soapRequest);
    }

    public function fetchGetImmeubleSerieConsosEAU(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetImmeuble($inputDto);

        return $this->safeCall('GetTableauBordImmeuble', $soapRequest);
    }

    public function fetchGetImmeubles(): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetListImmeubles();

        return $this->safeCall('GetInfosImmeubles', $soapRequest);
    }

    public function fetchGetImmeublesIndicators(): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetListImmeubles();

        return $this->safeCall('GetInfosImmeubles', $soapRequest);
    }

    public function fetchListAnomaliesByImmeuble(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateListAnomaliesByImmeuble($inputDto);

        return $this->safeCall('GetInfosAnomaliesByImmeuble', $soapRequest);
    }

    public function fetchListDysfonctionnementsByImmeuble(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateListDysfonctionnementsByImmeuble($inputDto);

        return $this->safeCall('GetInfosDysfonctionnementsByImmeuble', $soapRequest);
    }

    public function fetchListFuitesByImmeuble(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateListFuitesByImmeuble($inputDto);

        return $this->safeCall('GetInfosFuitesByImmeuble', $soapRequest);
    }

    public function fetchListInterventionsByImmeuble(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateListInterventionsByImmeuble($inputDto);

        return $this->safeCall('GetInfosDepannagesByImmeuble', $soapRequest);
    }

    public function fetchListLogementsByImmeuble(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateListLogementsByImmeuble($inputDto);

        return $this->safeCall('GetInfosLogementsByImmeuble', $soapRequest);
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
