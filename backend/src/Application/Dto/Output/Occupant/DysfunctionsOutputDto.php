<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Occupant;

final class DysfunctionsOutputDto
{
  public function __construct(public readonly array $items) {}
}

