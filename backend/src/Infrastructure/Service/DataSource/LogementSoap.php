<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataSource\LogementDataSourceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Hydrator\LogementHydrator;

final class LogementSoap extends Soap implements LogementDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly LogementHydrator $hydrator,
        private readonly AuthServiceInterface $authService
    ) {
        parent::__construct($soapClient);
    }

    public function fetchGetLogement(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetLogement($inputDto);

        return $this->safeCall('GetTableauBordLogement', $soapRequest);
    }

    public function fetchGetLogementCapteur(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetLogementCapteur($inputDto);

        return $this->safeCall('GetTableauBordLogement', $soapRequest);
    }

    public function fetchGetLogementCET(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetLogementCET($inputDto);

        return $this->safeCall('GetTableauBordLogement', $soapRequest);
    }

    public function fetchGetLogementEC(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetLogementEC($inputDto);

        return $this->safeCall('GetTableauBordLogement', $soapRequest);
    }

    public function fetchGetLogementEF(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetLogementEF($inputDto);

        return $this->safeCall('GetTableauBordLogement', $soapRequest);
    }

    public function fetchGetLogementElect(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetLogementElect($inputDto);

        return $this->safeCall('GetTableauBordLogement', $soapRequest);
    }

    public function fetchGetLogementGaz(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetLogementGaz($inputDto);

        return $this->safeCall('GetTableauBordLogement', $soapRequest);
    }

    public function fetchGetLogementRepart(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetLogementRepart($inputDto);

        return $this->safeCall('GetTableauBordLogement', $soapRequest);
    }

    public function fetchGetLogements(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return $this->safeCall('GetInfosLogementsByImmeuble', (object) []);
    }

    public function fetchListAnomaliesByLogement(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateListAnomaliesByLogement($inputDto);

        return $this->safeCall('GetInfosAnomaliesByLogement', $soapRequest);
    }

    public function fetchListDysfonctionnementsByLogement(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateListDysfonctionnementsByLogement($inputDto);

        return $this->safeCall('GetInfosDysfonctionnementsByLogement', $soapRequest);
    }

    public function fetchListFuitesByLogement(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateListFuitesByLogement($inputDto);

        return $this->safeCall('GetInfosFuitesByLogement', $soapRequest);
    }

    public function fetchListInterventionsByLogement(GetByIdIntInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateListInterventionsByLogement($inputDto);

        return $this->safeCall('GetInfosDepannagesByLogement', $soapRequest);
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
