<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Input\Operator\CreateOperatorInputDto;

use App\Application\Service\DataSource\OperatorDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Hydrator\OperatorHydrator;
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

  public function fetchGetOperators(ListOperatorsInputDto $inputDto): object
  {
      $authContext = $this->getAuthContext();
      $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
      $soapRequest = $this->hydrator->hydrateGetListOperators($inputDto); 
      return $this->soapClient->call('GetChildUsers', $soapRequest);  
  }

  public function fetchPostOperator(CreateOperatorInputDto $inputDto): bool
  {   
      $authContext = $this->getAuthContext();
      $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
      $soapRequest = $this->hydrator->hydratePostOperator($inputDto);
      return $this->soapClient->call('CreateGestionnaire', $soapRequest);  
  }

}
