<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Operator\SetImmeublesInpuDto;
use App\Application\Dto\Input\Operator\CreateGestionnaireInputDto;
use App\Application\Dto\Input\Operator\DeleteUserInpuDto;
use App\Application\Dto\Input\Operator\GetUserInpuDto;
use App\Application\Dto\Input\Operator\UpdateUserInpuDto;
use App\Application\Service\DataSource\OperatorDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Hydrator\OperatorHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

final class OperatorSoap implements OperatorDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly OperatorHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchSetImmeubles(SetImmeublesInpuDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateSetImmeubles($inputDto);
    return $this->soapClient->call('SetImmeubles', $soapRequest);
  }

  public function fetchCreateGestionnaire(CreateGestionnaireInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateCreateGestionnaire($inputDto);
    return $this->soapClient->call('CreateGestionnaire', $soapRequest);
  }

  public function fetchDeleteUser(DeleteUserInpuDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateDeleteUser($inputDto);
    return $this->soapClient->call('DeleteUser', $soapRequest);
  }

  public function fetchGetChildUsers(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetChildUsers();
    return $this->soapClient->call('GetChildUsers', $soapRequest);
  }

  public function fetchGetUser(GetUserInpuDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetUser($inputDto);
    return $this->soapClient->call('GetUser', $soapRequest);
  }

  public function fetchUpdateUser(UpdateUserInpuDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateUpdateUser($inputDto);
    return $this->soapClient->call('UpdateUser', $soapRequest);
  }

}
