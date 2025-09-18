<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Domain\Service\Soap\FactureSoapInterface;
use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Infrastructure\Hydrator\FactureHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class FactureSoap implements FactureSoapInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly FactureHydrator $hydrator,
    private readonly AuthenticationContext $authContext
  ) {
    // Set authentication context on the SOAP client
    $this->soapClient->setAuthentication($this->authContext->sessionId, $this->authContext->pkUser);
  }

  public function indexService(): array
  {
    $soapRequest = $this->hydrator->hydrateIndex();
    return $this->soapClient->call('getFactures', $soapRequest);
  }

  public function reportService(ReportInputDto $inputDto): array
  {
    $soapRequest = $this->hydrator->hydrateReport($inputDto);
    return $this->soapClient->call('GetReport', $soapRequest);
  }
}
