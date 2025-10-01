<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosAnomalies
{
  /**
   * @param InfosAnomalie[] $listeInfosAnomalies
   */
  public function __construct(
    public readonly array $listeInfosAnomalies
  ) {}
}
