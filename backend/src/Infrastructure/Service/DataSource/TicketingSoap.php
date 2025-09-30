<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Input\Ticketing\TicketListInputDto;
use App\Application\Service\DataSource\TicketingDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Hydrator\TicketingHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

final class TicketingSoap implements TicketingDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly TicketingHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchAttachmentTicket(AttachmentTicketInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateAttachmentTicket($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchCloseTicket(CloseTicketInputDto $inputDto): void
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateCloseTicket($inputDto);
    $this->soapClient->call('SetTicketStatus', $soapRequest);
  }

  public function fetchCreateTicket(CreateTicketInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateCreateTicket($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchMenuTicket(MenuTicketInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateMenuTicket($inputDto, $authContext);
    return $this->soapClient->call('', $soapRequest);
  }

  public function fetchTicketList(): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateTicketList();
    return $this->soapClient->call('GetTicketsIntersUser', $soapRequest);
  }
}
