<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Occupant;

final class ListDysfunctionsOutputDto
{
  public function __construct(public readonly array $items) {}
}

