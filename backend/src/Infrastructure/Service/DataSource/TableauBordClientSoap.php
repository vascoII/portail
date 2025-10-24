<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataSource\TableauBordClientDataSourceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;

final class TableauBordClientSoap extends Soap implements TableauBordClientDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly AuthServiceInterface $authService
    ) {
        parent::__construct($soapClient);
    }

    public function fetcGetTableauBordClient(): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return $this->safeCall('GetTableauBordClient', (object) []);
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
