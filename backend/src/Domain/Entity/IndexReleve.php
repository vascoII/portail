<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class IndexReleve
{
  public function __construct(
    public readonly ?\DateTime $dateReleve,
    public readonly ?float $index,
    public readonly ?float $conso
  ) {}
}
