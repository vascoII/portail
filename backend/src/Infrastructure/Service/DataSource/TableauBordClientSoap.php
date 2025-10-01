<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Service\DataSource\TableauBordClientDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

final class TableauBordClientSoap implements TableauBordClientDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetcGetTableauBordClient(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->soapClient->call('GetTableauBordClient', (object) []);
  }
}
