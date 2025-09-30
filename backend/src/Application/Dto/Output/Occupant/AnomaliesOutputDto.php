<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Occupant;

final class AnomaliesOutputDto
{
  public function __construct(public readonly array $items) {}
}

