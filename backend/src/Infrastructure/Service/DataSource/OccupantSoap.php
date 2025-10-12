<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

use App\Application\Service\DataSource\OccupantDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Hydrator\OccupantHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;

final class OccupantSoap extends Soap implements OccupantDataSourceInterface
{
  public function __construct(
    SoapClient $soapClient,
    private readonly OccupantHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {
    parent::__construct($soapClient);
  }

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchGetOccupant(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetOccupant($inputDto);
    return $this->safeCall('GetTableauBordOccupant', $soapRequest);
  }

  public function fetchListAlertesByOccupant(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->safeCall('GetInfosAnomaliesByOccupant', (object) []);
  }

  public function fetchListAnomaliesByOccupant(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->safeCall('GetInfosAnomaliesByOccupant', (object) []);
  }

  public function fetchListDysfonctionnementsByOccupant(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->safeCall('GetInfosDysfonctionnementsByOccupant', (object) []);
  }

  public function fetchListFuitesByOccupant(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->safeCall('GetInfosFuitesByOccupant', (object) []);
  }

  public function fetchListInterventionsByOccupant(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->safeCall('GetInfosDepannagesByOccupant', (object) []);
  }

  public function fetchListOccupantsByOccupant(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->safeCall('GetInfosOccupants', (object) []);
  }

  public function fetchGetOccupantAccount(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->safeCall('GetInfosOccupantAccount', (object) []);
  }
}
