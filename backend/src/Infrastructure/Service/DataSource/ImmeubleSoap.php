<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Immeuble\GetTableauBordImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosAnomaliesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosLogementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDepannagesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDysfonctionnementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosFuitesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosImmeublesInputDto;
use App\Application\Service\DataSource\ImmeubleDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Hydrator\ImmeubleHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

final class ImmeubleSoap implements ImmeubleDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly ImmeubleHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchGetTableauBordImmeuble(GetTableauBordImmeubleInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetTableauBordImmeuble($inputDto);
    return $this->soapClient->call('GetTableauBordImmeuble', $soapRequest);
  }

  public function fetchGetInfosAnomaliesByImmeuble(GetInfosAnomaliesByImmeubleInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetInfosAnomaliesByImmeuble($inputDto);
    return $this->soapClient->call('GetInfosAnomaliesByImmeuble', $soapRequest);
  }

  public function fetchGetInfosLogementsByImmeuble(GetInfosLogementsByImmeubleInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetInfosLogementsByImmeuble($inputDto);
    return $this->soapClient->call('GetInfosLogementsByImmeuble', $soapRequest);
  }

  public function fetchGetInfosDepannagesByImmeuble(GetInfosDepannagesByImmeubleInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetInfosDepannagesByImmeuble($inputDto);
    return $this->soapClient->call('GetInfosDepannagesByImmeuble', $soapRequest);
  }

  public function fetchGetInfosDysfonctionnementsByImmeuble(GetInfosDysfonctionnementsByImmeubleInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetInfosDysfonctionnementsByImmeuble($inputDto);
    return $this->soapClient->call('GetInfosDysfonctionnementsByImmeuble', $soapRequest);
  }

  public function fetchGetInfosFuitesByImmeuble(GetInfosFuitesByImmeubleInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetInfosFuitesByImmeuble($inputDto);
    return $this->soapClient->call('GetInfosFuitesByImmeuble', $soapRequest);
  }

  public function fetchGetInfosImmeubles(GetInfosImmeublesInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetInfosImmeubles($inputDto);
    return $this->soapClient->call('GetInfosImmeubles', $soapRequest);
  }

}
