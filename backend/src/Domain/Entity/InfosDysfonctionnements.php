<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosDysfonctionnements
{
  /**
   * @param InfosDysfonctionnement[] $listeInfosDysfonctionnements
   */
  public function __construct(
    public readonly array $listeInfosDysfonctionnements
  ) {}
}
