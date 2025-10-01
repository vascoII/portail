<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

final class GetTicketsIntersUserOutputDto
{
  public function __construct(
    public readonly TicketsInter $ticketsInter
  ) {}
}
