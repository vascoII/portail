<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Input\Front\PersonalDatasInputDto;
use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use App\Application\Service\DataSource\FrontDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Hydrator\FrontHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class FrontSoap implements FrontDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly FrontHydrator $hydrator,
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

  public function fetchCgu(CguInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchPersonalDatas(PersonalDatasInputDto $inputDto): object
  {
   $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchLegalNotices(LegalNoticesInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }
}
