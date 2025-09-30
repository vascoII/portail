<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Input\Occupant\ExportAnomaliesInputDto;
use App\Application\Dto\Input\Occupant\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\ExportInterventionsInputDto;
use App\Application\Dto\Input\Occupant\ExportLeaksInputDto;
use App\Application\Dto\Input\Occupant\AnomaliesInputDto;
use App\Application\Dto\Input\Occupant\DysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\InterventionsInputDto;
use App\Application\Dto\Input\Occupant\LeaksInputDto;
use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Application\Dto\Input\Occupant\EditInputDto;
use App\Application\Service\DataSource\OccupantDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Hydrator\OccupantHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

final class OccupantSoap implements OccupantDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly OccupantHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchAlertes(AlertesInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateAlertes($inputDto, $authContext);
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

  public function fetchListInterventions(InterventionsInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateListInterventions($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchListLeaks(LeaksInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateListLeaks($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchMyAccount(MyAccountInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateMyAccount($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchShowEauReleve(ShowEauReleveInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateShowEauReleve($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateShowIntervention($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchShowNoteReleve(ShowNoteReleveInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateShowNoteReleve($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchShowRepartReleve(ShowRepartReleveInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateShowRepartReleve($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchShow(ShowInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateShow($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchSimulateur(SimulateurInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateSimulateur($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchEdit(EditInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateEdit($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }
}
