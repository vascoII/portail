<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataSource\FactureDataSourceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;

final class FactureSoap extends Soap implements FactureDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly AuthServiceInterface $authService
    ) {
        parent::__construct($soapClient);
    }

    public function fetchGetFactures(): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return $this->safeCall('getFactures', (object) []);
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
