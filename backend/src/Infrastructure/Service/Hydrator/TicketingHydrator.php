<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Ticketing\CreateTicketInterInputDto;
use App\Application\Dto\Input\Ticketing\GetAttachmentInputDto;
use App\Application\Dto\Input\Ticketing\GetTicketInterInitInputDto;
use App\Application\Dto\Input\Ticketing\GetTicketsIntersUserInputDto;
use App\Application\Dto\Input\Ticketing\SetTicketStatusInputDto;

final class TicketingHydrator
{
  public function hydrateCreateTicketInter(CreateTicketInterInputDto $inputDto): object
  {
    return (object) [
      'PkLogement' => $inputDto->pkLogement,
      'Nom' => $inputDto->name,
      'Email' => $inputDto->email,
      'TelFixe' => $inputDto->phone,
      'TelMobile' => $inputDto->mobile,
      'Objet' => $inputDto->objet,
      'MotifLibre' => $inputDto->message
    ];
  }

  public function hydrateGetAttachment(GetAttachmentInputDto $inputDto): object
  {
    return (object) [
      'PkTicketInter' => $inputDto->pkTicketInter
    ];
  }

  public function hydrateGetTicketInterInit(GetTicketInterInitInputDto $inputDto): object
  {
    return (object) [
      'PkLogement' => $inputDto->pkLogement
    ];
  }

  public function hydrateGetTicketsIntersUser(GetTicketsIntersUserInputDto $inputDto): object
  {
    return (object) [
      'ParamsFiltres' => 'SHOWALL = ' . $inputDto->paramsFiltres
    ];
  }

  public function hydrateSetTicketStatus(SetTicketStatusInputDto $inputDto): object
  {
    return (object) [
      'pkticket' => $inputDto->pkTicket,
      'statut' => $inputDto->statut
    ];
  }
}
