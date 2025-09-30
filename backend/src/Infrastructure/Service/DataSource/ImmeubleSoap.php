<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Immeuble\IndexInputDto;
use App\Application\Dto\Input\Immeuble\ShowInputDto;
use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Input\Immeuble\InterventionsInputDto;
use App\Application\Dto\Input\Immeuble\ShowInterventionInputDto;
use App\Application\Dto\Input\Immeuble\InterventionInputDto;
use App\Application\Dto\Input\Immeuble\LeaksInputDto;
use App\Application\Dto\Input\Immeuble\DysfunctionsInputDto;
use App\Application\Dto\Input\Immeuble\AnomaliesInputDto;
use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use App\Application\Service\DataSource\ImmeubleDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Hydrator\ImmeubleHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

final class ImmeubleSoap implements ImmeubleDataSourceInterface
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

  public function fetchIndex(IndexInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIndex($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchShow(ShowInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateShow($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchReport(ReportInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateReport($inputDto, $authContext);
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

  public function fetchIntervention(InterventionInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateIntervention($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchListLeaks(LeaksInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateListLeaks($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchListDysfunctions(DysfunctionsInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateListDysfunctions($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchListAnomalies(AnomaliesInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateListAnomalies($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchFilterResult(FilterResultInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateFilterResult($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

}
