<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

final class CreateTicketInterOutputDto
{
  public function __construct(
    public readonly int $ticketId
  ) {}
}
