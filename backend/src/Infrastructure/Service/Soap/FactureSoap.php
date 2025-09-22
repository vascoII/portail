<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Domain\Service\Soap\FactureSoapInterface;
use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Infrastructure\Hydrator\FactureHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class FactureSoap implements FactureSoapInterface
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

  public function indexService(): array
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($authContext);
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function reportService(ReportInputDto $inputDto): array
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateReport($inputDto, $authContext);
    return $this->soapClient->call('GetReport', $soapRequest);
  }
}
