<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\ReportToken\LoadingInputDto;
use App\Application\Dto\Input\ReportToken\ReportInputDto;
use App\Domain\Service\Soap\ReportTokenSoapInterface;
use App\Infrastructure\Hydrator\ReportTokenHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class ReportTokenSoap implements ReportTokenSoapInterface
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

  public function loadingService(LoadingInputDto $inputDto): array
  {
    // TODO: Implement loadingService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function reportService(ReportInputDto $inputDto): array
  {
    // TODO: Implement reportService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }
}
