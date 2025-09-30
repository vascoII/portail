<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Input\GestionParc\InterventionsInputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Input\GestionParc\LeaksInputDto;
use App\Application\Dto\Input\GestionParc\AnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\DysfunctionsInputDto;
use App\Application\Service\DataSource\GestionParcDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Hydrator\GestionParcHydrator;
use App\Infrastructure\Service\DataSource\SoapClient;

final class GestionParcSoap implements GestionParcDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly GestionParcHydrator $hydrator,
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
    return $this->soapClient->call('GetTableauBordClient', (object) []);
  }

  public function fetchIntervention(InterventionInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIntervention($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchReport(ReportInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateReport($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchShow(ShowInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateShow($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchListInterventions(InterventionsInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateListInterventions($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateShowIntervention($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchFilterResult(FilterResultInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateFilterResult($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchListLeaks(LeaksInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateListLeaks($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchListAnomalies(AnomaliesInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateListAnomalies($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchListDysfunctions(DysfunctionsInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateListDysfunctions($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }
}
