<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

final class SetTicketStatusOutputDto
{
  public function __construct(
    public readonly bool $success
  ) {}
}
