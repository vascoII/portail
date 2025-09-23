<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Front\IndexInputDto;
use App\Application\Dto\Input\Front\CguInputDto;
use App\Application\Dto\Input\Front\PersonalDatasInputDto;
use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use App\Domain\Service\Soap\FrontSoapInterface;
use App\Infrastructure\Hydrator\FrontHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class FrontSoap implements FrontSoapInterface
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

  public function indexService(IndexInputDto $inputDto): array
  {
    // TODO: Implement indexService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function cguService(CguInputDto $inputDto): array
  {
    // TODO: Implement cguService logic
    return [];
  }

  public function personalDatasService(PersonalDatasInputDto $inputDto): array
  {
    // TODO: Implement personalDatasService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function legalNoticesService(LegalNoticesInputDto $inputDto): array
  {
    // TODO: Implement legalNoticesService logic
    return [];
  }
}
