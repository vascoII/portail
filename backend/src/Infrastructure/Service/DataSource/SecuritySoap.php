<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Service\DataSource\SecurityDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Hydrator\SecurityHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class SecuritySoap implements SecurityDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly SecurityHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchCreate(CreateInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchLoginFromParam(LoginFromParamInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchLogout(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchResetOrCreate(ResetOrCreateInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchUpdatePassword(UpdatePasswordInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchResetPassword(ResetPasswordInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchLogin(LoginInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

}
