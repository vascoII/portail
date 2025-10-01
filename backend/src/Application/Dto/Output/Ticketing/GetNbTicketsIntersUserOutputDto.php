<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

final class GetNbTicketsIntersUserOutputDto
{
  public function __construct(
    public readonly int $nbTickets
  ) {}
}
