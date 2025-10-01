<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class GraphPoint
{
  public function __construct(
    public readonly ?\DateTime $date,
    public readonly ?float $value
  ) {}
}
