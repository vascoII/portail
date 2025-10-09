<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Application\Dto\Input\Operator\PutOperatorInputDto;
use App\Application\Dto\Input\Operator\PatchOperatorInputDto;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

use App\Application\Service\DataSource\OperatorDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Hydrator\OperatorHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;

final class OperatorSoap extends Soap implements OperatorDataSourceInterface
{
  public function __construct(
    SoapClient $soapClient,
    private readonly OperatorHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {
    parent::__construct($soapClient);
  }

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchGetOperators(ListOperatorsInputDto $inputDto): object
  {
      $authContext = $this->getAuthContext();
      $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
      $soapRequest = $this->hydrator->hydrateGetListOperators($inputDto); 
      return $this->safeCall('GetChildUsers', $soapRequest);  
  }

  public function fetchPostOperator(CreateOperatorInputDto $inputDto): bool
  {   
      $authContext = $this->getAuthContext();
      $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
      $soapRequest = $this->hydrator->hydratePostOperator($inputDto); dd($soapRequest);
      return $this->safeCall('CreateGestionnaire', $soapRequest);  
  }

  public function fetchGetOperator(GetByIdIntInputDto $inputDto): object
  {
      $authContext = $this->getAuthContext();
      $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
      $soapRequest = $this->hydrator->hydrateGetOperator($inputDto);
      return $this->safeCall('GetUser', $soapRequest);  
  }

  public function fetchPutOperator(PutOperatorInputDto $inputDto): object
  {
      $authContext = $this->getAuthContext();
      $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
      $soapRequest = $this->hydrator->hydratePutOperator($inputDto);
      return $this->safeCall('UpdateUser', $soapRequest);  
  }

  public function fetchPatchOperator(PatchOperatorInputDto $inputDto): object
  {
      $authContext = $this->getAuthContext();
      $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
      $soapRequest = $this->hydrator->hydratePatchOperator($inputDto);
      return $this->safeCall('UpdatePassword', $soapRequest);
  }

  public function fetchDeleteOperator(GetByIdIntInputDto $inputDto): object
  {
      $authContext = $this->getAuthContext();
      $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
      $soapRequest = $this->hydrator->hydrateDeleteOperator($inputDto);
      return $this->safeCall('DeleteUser', $soapRequest);
  }

}
