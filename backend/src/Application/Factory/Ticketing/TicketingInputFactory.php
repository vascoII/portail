<?php

declare(strict_types=1);

namespace App\Application\Factory\Ticketing;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Ticketing\CreateTicketInterInputDto;
use App\Application\Dto\Input\Ticketing\GetAttachmentInputDto;
use App\Application\Dto\Input\Ticketing\GetTicketInterInitInputDto;
use App\Application\Dto\Input\Ticketing\GetTicketsIntersUserInputDto;
use App\Application\Dto\Input\Ticketing\SetTicketStatusInputDto;

final class TicketingInputFactory
{
  public function createCreateTicketInterFromRequest(Request $request): CreateTicketInterInputDto
  {
    return new CreateTicketInterInputDto(
      (int) $request->request->get('pkLogement'),
      (string) $request->request->get('name'),
      (string) $request->request->get('email'),
      (string) $request->request->get('phone'),
      (string) $request->request->get('mobile'),
      (string) $request->request->get('objet'),
      (string) $request->request->get('message')
    );
  }

  public function createGetAttachmentFromRequest(Request $request): GetAttachmentInputDto
  {
    return new GetAttachmentInputDto((int) $request->query->get('pkTicketInter'));
  }

  public function createGetTicketInterInitFromRequest(Request $request): GetTicketInterInitInputDto
  {
    return new GetTicketInterInitInputDto((int) $request->query->get('pkLogement'));
  }

  public function createGetTicketsIntersUserFromRequest(Request $request): GetTicketsIntersUserInputDto
  {
    return new GetTicketsIntersUserInputDto((string) $request->query->get('paramsFiltres'));
  }

  public function createSetTicketStatusFromRequest(Request $request): SetTicketStatusInputDto
  {
    return new SetTicketStatusInputDto(
      (int) $request->request->get('pkTicket'),
      (string) $request->request->get('statut')
    );
  }
}
