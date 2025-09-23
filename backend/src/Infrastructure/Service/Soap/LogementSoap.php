<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Input\Logement\ListInterventionsInputDto;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Input\Logement\ListLeaksInputDto;
use App\Application\Dto\Input\Logement\ListDysfunctionsInputDto;
use App\Application\Dto\Input\Logement\ListAnomaliesInputDto;
use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Input\Logement\ExportInputDto;
use App\Application\Dto\Input\Logement\ExportInterventionsInputDto;
use App\Application\Dto\Input\Logement\ExportLeaksInputDto;
use App\Application\Dto\Input\Logement\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\Logement\ExportAnomaliesInputDto;
use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Input\Logement\CreateTicketInputDto;
use App\Application\Dto\Input\Logement\CreateTicketImmeubleInputDto;
use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Input\Logement\GuideInputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;
use App\Domain\Service\Soap\LogementSoapInterface;
use App\Infrastructure\Hydrator\LogementHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class LogementSoap implements LogementSoapInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly LogementHydrator $hydrator,
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

  public function searchService(SearchInputDto $inputDto): array
  {
    // TODO: Implement searchService logic
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

  public function exportService(ExportInputDto $inputDto): array
  {
    // TODO: Implement exportService logic
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

  public function editService(EditInputDto $inputDto): array
  {
    // TODO: Implement editService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function createTicketService(CreateTicketInputDto $inputDto): array
  {
    // TODO: Implement createTicketService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function createTicketImmeubleService(CreateTicketImmeubleInputDto $inputDto): array
  {
    // TODO: Implement createTicketImmeubleService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function getTicketOnwerService(GetTicketOnwerInputDto $inputDto): array
  {
    // TODO: Implement getTicketOnwerService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function guideService(GuideInputDto $inputDto): array
  {
    // TODO: Implement guideService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function getInfosAppareilService(GetInfosAppareilInputDto $inputDto): array
  {
    // TODO: Implement getInfosAppareilService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): array
  {
    // TODO: Implement showRepartReleveService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }
}
