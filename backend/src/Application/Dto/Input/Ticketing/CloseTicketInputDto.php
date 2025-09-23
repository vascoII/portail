<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Ticketing;

final class CloseTicketInputDto
{
  const STATUS = "Clos";

  public function __construct(
      public readonly string $pkTicket,
      public readonly string $statut = self::STATUS
  ) {}
}
