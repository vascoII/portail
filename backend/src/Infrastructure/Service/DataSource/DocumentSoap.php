<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataSource\DocumentDataSourceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;

final class DocumentSoap extends Soap implements DocumentDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly AuthServiceInterface $authService
    ) {
        parent::__construct($soapClient);
    }

    public function fetchImmeubleAnomalies(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchImmeubleDysfonctionnements(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchImmeubleFuites(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchImmeubleInterventions(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchLogementAnomalies(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchLogementDysfonctionnements(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchLogementFuites(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchLogementInterventions(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchOccupantAnomalies(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchOccupantDysfonctionnements(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchOccupantFuites(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    public function fetchOccupantInterventions(GetByIdStringInputDto $inputDto): bool
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return true;
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
