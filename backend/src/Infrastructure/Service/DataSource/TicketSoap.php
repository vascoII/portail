<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Ticket\CreateTicketInterInputDto;
use App\Application\Service\DataSource\TicketDataSourceInterface;
use App\Infrastructure\Service\Hydrator\TicketHydrator;

final class TicketSoap extends Soap implements TicketDataSourceInterface
{
  public function __construct(
    SoapClient $soapClient,
    private readonly TicketHydrator $hydrator
  ) {
    parent::__construct($soapClient);
  }

  public function fetchListTickets(): object
  {
    $soapRequest = $this->hydrator->hydrateListTickets();
    return $this->safeCall('GetTicketsIntersUser', $soapRequest);
  }

  public function fetchCreateTicket(CreateTicketInterInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydrateCreateTicket($inputDto);
    return $this->safeCall('CreateTicket', $soapRequest);
  }

  public function fetchPatchTicket(GetByIdIntInputDto $inputDto): object
  {
    $soapRequest = $this->hydrator->hydratePatchTicket($inputDto);
    return $this->safeCall('SetTicketStatus', $soapRequest);
  }
}
