<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Ticketing;

final class CreateTicketInputDto
{
  /**
   * Accepts arbitrary payload; adjust fields as needed when integrating.
   */
  public function __construct(public readonly array $payload) {}
}
