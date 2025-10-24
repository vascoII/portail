<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataSource\ParcDataSourceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Hydrator\ParcHydrator;

final class ParcSoap extends Soap implements ParcDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly ParcHydrator $hydrator,
        private readonly AuthServiceInterface $authService
    ) {
        parent::__construct($soapClient);
    }

    public function fetchGetParc(): object
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
