<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Ticketing;

final class CloseTicketInputDto
{
  public function __construct(public readonly string $ticketId) {}
}
