<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

use App\Domain\Entity\TicketInter;

final class GetTicketsIntersUserOutputDto
{
  
  /** @param TicketInter[] $ticketsInter */
  public function __construct(
    public readonly array $ticketsInter
  ) {}
}
