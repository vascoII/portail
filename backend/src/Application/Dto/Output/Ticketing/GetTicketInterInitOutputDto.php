<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

use App\Domain\Entity\TicketInterInit;

final class GetTicketInterInitOutputDto
{
  public function __construct(
    public readonly TicketInterInit $ticketInterInit
  ) {}
}
