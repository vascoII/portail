<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Immeubles
{
  /**
   * @param Immeuble[] $listeImmeubles
   */
  public function __construct(
    public readonly array $listeImmeubles
  ) {}
}
