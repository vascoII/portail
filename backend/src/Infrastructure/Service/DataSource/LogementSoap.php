<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

use App\Application\Service\DataSource\LogementDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Hydrator\LogementHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;

final class LogementSoap extends Soap implements LogementDataSourceInterface
{
  public function __construct(
    SoapClient $soapClient,
    private readonly LogementHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {
    parent::__construct($soapClient);
  }

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchGetLogements(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetListLogements();
    return $this->safeCall('GetInfosLogements', $soapRequest);
  }

  public function fetchGetLogement(GetByIdIntInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetLogement($inputDto);
    return $this->safeCall('GetTableauBordLogement', $soapRequest);
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

  public function fetchListLogementsByLogement(GetByIdIntInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateListLogementsByLogement($inputDto);
    return $this->safeCall('GetInfosLogements', $soapRequest);
  }
}
