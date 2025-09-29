<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\ReportToken\LoadingInputDto;
use App\Application\Dto\Input\ReportToken\ReportInputDto;
use App\Application\Service\DataSource\ReportTokenDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Hydrator\ReportTokenHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class ReportTokenSoap implements ReportTokenDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly ReportTokenHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchLoading(LoadingInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function fetchReport(ReportInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }
}
