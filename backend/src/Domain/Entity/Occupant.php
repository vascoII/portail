<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Occupant
{
  public function __construct(
    public readonly ?int $pkOccupant,
    public readonly ?string $nom,
    public readonly ?string $ref,
    public readonly ?\DateTime $dateArrivee,
    public readonly ?\DateTime $dateDepart
  ) {}
}
