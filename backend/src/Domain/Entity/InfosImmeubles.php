<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosImmeubles
{
  /**
   * @param InfosImmeuble[] $listeInfosImmeubles
   */
  public function __construct(
    public readonly array $listeInfosImmeubles
  ) {}
}
