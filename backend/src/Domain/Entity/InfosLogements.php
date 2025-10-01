<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosLogements
{
  /**
   * @param InfosLogement[] $listeInfosLogements
   */
  public function __construct(
    public readonly array $listeInfosLogements
  ) {}
}
