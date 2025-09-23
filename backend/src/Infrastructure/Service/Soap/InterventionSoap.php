<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Intervention\ReportInputDto;
use App\Domain\Service\Soap\InterventionSoapInterface;
use App\Infrastructure\Hydrator\InterventionHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class InterventionSoap implements InterventionSoapInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly InterventionHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function reportService(ReportInputDto $inputDto): array
  {
    // TODO: Implement reportService logic
    return [];
  }
}
