<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Input\Immeuble\ListInterventionsInputDto;
use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Input\Immeuble\LinterventionInputDto;
use App\Application\Dto\Input\Immeuble\ListLeaksInputDto;
use App\Application\Dto\Input\Immeuble\ListDysfunctionsInputDto;
use App\Application\Dto\Input\Immeuble\ListAnomaliesInputDto;
use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use App\Application\Dto\Input\Immeuble\ExportInterventionsInputDto;
use App\Application\Dto\Input\Immeuble\ExportLeaksInputDto;
use App\Application\Dto\Input\Immeuble\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\Immeuble\ExportAnomaliesInputDto;
use App\Domain\Service\Soap\ImmeubleSoapInterface;
use App\Infrastructure\Hydrator\ImmeubleHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class ImmeubleSoap implements ImmeubleSoapInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly ImmeubleHydrator $hydrator,
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

  public function showService(ShowInputDto $inputDto): array
  {
    // TODO: Implement showService logic
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

  public function listInterventionsService(ListInterventionsInputDto $inputDto): array
  {
    // TODO: Implement listInterventionsService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function showInterventionService(ShowInterventionInputDto $inputDto): array
  {
    // TODO: Implement showInterventionService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function linterventionService(LinterventionInputDto $inputDto): array
  {
    // TODO: Implement linterventionService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function listLeaksService(ListLeaksInputDto $inputDto): array
  {
    // TODO: Implement listLeaksService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): array
  {
    // TODO: Implement listDysfunctionsService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): array
  {
    // TODO: Implement listAnomaliesService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function filterResultService(FilterResultInputDto $inputDto): array
  {
    // TODO: Implement filterResultService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): array
  {
    // TODO: Implement exportInterventionsService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function exportLeaksService(ExportLeaksInputDto $inputDto): array
  {
    // TODO: Implement exportLeaksService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): array
  {
    // TODO: Implement exportDysfunctionsService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): array
  {
    // TODO: Implement exportAnomaliesService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }
}
