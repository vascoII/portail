<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Input\Logement\InterventionsInputDto;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Input\Logement\LeaksInputDto;
use App\Application\Dto\Input\Logement\DysfunctionsInputDto;
use App\Application\Dto\Input\Logement\AnomaliesInputDto;
use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Input\Logement\CreateTicketInputDto;
use App\Application\Dto\Input\Logement\CreateTicketImmeubleInputDto;
use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Input\Logement\GuideInputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;
use App\Application\Service\DataSource\LogementDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Hydrator\LogementHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

final class LogementSoap implements LogementDataSourceInterface
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

  public function fetchSearch(SearchInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateSearch($inputDto, $authContext);
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

  public function fetchEdit(EditInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateEdit($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchCreateTicket(CreateTicketInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateCreateTicket($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchCreateTicketImmeuble(CreateTicketImmeubleInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateCreateTicketImmeuble($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchGetTicketOnwer(GetTicketOnwerInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetTicketOnwer($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchGuide(GuideInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGuide($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchGetInfosAppareil(GetInfosAppareilInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetInfosAppareil($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchShowRepartReleve(ShowRepartReleveInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateShowRepartReleve($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }
}
