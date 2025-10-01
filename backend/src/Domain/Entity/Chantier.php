<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Chantier
{
  public function __construct(
    public readonly ?int $pkChantier,
    public readonly ?int $pkDevis,
    public readonly ?int $pkImmeuble,
    public readonly ?\DateTime $dateEntreeChantier,
    public readonly ?int $nbCompteursPoses,
    public readonly ?int $nbCompteursCommandes
  ) {}
}
