<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Ticketing\CreateTicketInterInputDto;
use App\Application\Dto\Input\Ticketing\GetAttachmentInputDto;
use App\Application\Dto\Input\Ticketing\GetTicketInterInitInputDto;
use App\Application\Dto\Input\Ticketing\GetTicketsIntersUserInputDto;
use App\Application\Dto\Input\Ticketing\SetTicketStatusInputDto;
use App\Application\Service\DataSource\TicketingDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Hydrator\TicketingHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

final class TicketingSoap extends Soap implements TicketingDataSourceInterface
{
  public function __construct(
    SoapClient $soapClient,
    private readonly TicketingHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {
    parent::__construct($soapClient);
  }

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchCheckTicketsInterEnabled($inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->safeCall('CheckTicketsInterEnabled', (object) []);
  }

  public function fetchCreateTicketInter(CreateTicketInterInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateCreateTicketInter($inputDto);
    return $this->safeCall('CreateTicketInter', $soapRequest);
  }

  public function fetchGetAttachment(GetAttachmentInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetAttachment($inputDto);
    return $this->safeCall('GetAttachment', $soapRequest);
  }

  public function fetchGetTicketInterInit(GetTicketInterInitInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetTicketInterInit($inputDto);
    return $this->safeCall('GetTicketInterInit', $soapRequest);
  }

	public function fetchGetTicketsIntersUser(GetTicketsIntersUserInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetTicketsIntersUser($inputDto);
    return $this->safeCall('GetTicketsIntersUser', $soapRequest);
  }

	public function fetchSetTicketStatus(SetTicketStatusInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateSetTicketStatus($inputDto);
    return $this->safeCall('SetTicketStatus', $soapRequest);
  }

	public function fetchGetNbTicketsIntersUser(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return $this->safeCall('GetNbTicketsIntersUser', (object) []);
  }
}
