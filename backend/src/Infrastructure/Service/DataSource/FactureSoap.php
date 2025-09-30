<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Service\DataSource\FactureDataSourceInterface;
use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Hydrator\FactureHydrator;
use App\Infrastructure\Service\Soap\SoapClient;

final class FactureSoap implements FactureDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly FactureHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchIndex(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->soapClient->call('getFactures', (object) []);
  }

  public function fetchReport(ReportInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateReport($inputDto);
    return $this->soapClient->call('GetReport', $soapRequest);
  }
}
