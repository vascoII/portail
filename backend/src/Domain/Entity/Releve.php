<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Releve
{
  public function __construct(
    public readonly ?int $pkReleve,
    public readonly ?\DateTime $dateReleve,
    public readonly ?string $typeErc
  ) {}
}
