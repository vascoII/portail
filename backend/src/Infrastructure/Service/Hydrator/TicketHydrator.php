<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

final class TicketHydrator
{
  public function hydrateListTickets(): object
  {
    return (object) [
      // TODO: Add specific parameters when SOAP method is known
    ];
  }

  public function hydrateGetTicket(GetByIdIntInputDto $inputDto): object
  {
    return (object) [
      'Id' => $inputDto->id,
      // TODO: Add specific parameters when SOAP method is known
    ];
  }

  public function hydrateCreateTicket(GetByIdIntInputDto $inputDto): object
  {
    return (object) [
      'Id' => $inputDto->id,
      // TODO: Add specific parameters when SOAP method is known
    ];
  }

  public function hydratePatchTicket(GetByIdIntInputDto $inputDto): object
  {
    return (object) [
      'Id' => $inputDto->id,
      // TODO: Add specific parameters when SOAP method is known
    ];
  }
}
