<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

final class TicketsInter
{
  /** @param TicketInter[] $listeTicketsInter */
  public function __construct(
    public readonly array $listeTicketsInter
  ) {}
}
