<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Operator\IndexInputDto;
use App\Application\Dto\Input\Operator\CreateInputDto;
use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use App\Application\Dto\Input\Operator\RemoveBuildingInputDto;
use App\Application\Dto\Input\Operator\ViewInputDto;
use App\Application\Dto\Input\Operator\EditInputDto;
use App\Application\Dto\Input\Operator\EditPasswordInputDto;
use App\Application\Dto\Input\Operator\DeleteInputDto;
use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;
use App\Domain\Service\Soap\OperatorSoapInterface;
use App\Infrastructure\Hydrator\OperatorHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class OperatorSoap implements OperatorSoapInterface
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

  public function indexService(IndexInputDto $inputDto): array
  {
    // TODO: Implement indexService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function createService(CreateInputDto $inputDto): array
  {
    // TODO: Implement createService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function addBuildingService(AddBuildingInputDto $inputDto): array
  {
    // TODO: Implement addBuildingService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function removeBuildingService(RemoveBuildingInputDto $inputDto): array
  {
    // TODO: Implement removeBuildingService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function viewService(ViewInputDto $inputDto): array
  {
    // TODO: Implement viewService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function editService(EditInputDto $inputDto): array
  {
    // TODO: Implement editService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function editPasswordService(EditPasswordInputDto $inputDto): array
  {
    // TODO: Implement editPasswordService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function deleteService(DeleteInputDto $inputDto): array
  {
    // TODO: Implement deleteService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function otatsoccupantsService(OtatsoccupantsInputDto $inputDto): array
  {
    // TODO: Implement otatsoccupantsService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }
}
