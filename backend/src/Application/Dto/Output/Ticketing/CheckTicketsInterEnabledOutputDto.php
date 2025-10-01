<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ticketing;

final class CheckTicketsInterEnabledOutputDto
{
  public function __construct(
    public readonly bool $enabled
  ) {}
}
