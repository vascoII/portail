<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Application\Service\DataSource\TableauBordClientDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Hydrator\TableauBordClientHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class TableauBordClientSoap implements TableauBordClientDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly TableauBordClientHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchIndex(IndexInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchIntervention(InterventionInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }
}
