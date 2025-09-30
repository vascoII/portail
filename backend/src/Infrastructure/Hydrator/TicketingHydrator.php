<?php

declare(strict_types=1);

namespace App\Infrastructure\Hydrator;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use App\Application\Dto\Input\Ticketing\MenuTicketInputDto;
use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use App\Application\Dto\Input\Ticketing\TicketListInputDto;

final class TicketingHydrator
{
  public function hydrateAttachmentTicket(AttachmentTicketInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on AttachmentTicketInputDto properties
    ];
  }

  public function hydrateCloseTicket(CloseTicketInputDto $inputDto): object
  {
    return (object) [
      'pkticket' => $inputDto->pkTicket,
      'statut'   => $inputDto->statut,
    ];
  }

  public function hydrateCreateTicket(CreateTicketInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on CreateTicketInputDto properties
    ];
  }

  public function hydrateMenuTicket(MenuTicketInputDto $inputDto, AuthenticationContext $authContext): object
  {
    return (object) [
      'SessionID' => $authContext->sessionId,
      'PkUser' => $authContext->pkUser,
      // TODO: Add specific parameters based on MenuTicketInputDto properties
    ];
  }

  public function hydrateTicketList(): object
  {
    return (object) [
      'ParamsFiltres' => 'SHOWALL ='
    ];
  }
}
