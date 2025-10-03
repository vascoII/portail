<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Input\Security\ResetPasswordFromPKUserInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Service\DataSource\SecurityDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Hydrator\SecurityHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

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

  public function fetchLogin(LoginInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateLogin($inputDto);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchLogout(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->soapClient->call('Logout', (object) []);
  }

  public function fetchResetPasswordFromPKUser(ResetPasswordFromPKUserInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateResetPasswordFromPKUser($inputDto);
    return $this->soapClient->call('ResetPasswordFromPKUser', $soapRequest);
  }

  public function fetchUpdatePassword(UpdatePasswordInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateUpdatePassword($inputDto);
    return $this->soapClient->call('UpdatePassword', $soapRequest);
  }

}
