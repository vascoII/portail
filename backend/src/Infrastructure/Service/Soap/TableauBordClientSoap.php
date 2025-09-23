<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\TableauBordClient\IndexInputDto;
use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Domain\Service\Soap\TableauBordClientSoapInterface;
use App\Infrastructure\Hydrator\TableauBordClientHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class TableauBordClientSoap implements TableauBordClientSoapInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly TableauBordClientHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(IndexInputDto $inputDto): array
  {
    // TODO: Implement indexService logic
    return [];
  }

  public function interventionService(InterventionInputDto $inputDto): array
  {
    // TODO: Implement interventionService logic
    return [];
  }
}
