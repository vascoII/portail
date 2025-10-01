<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class InfosAnomalies
{
  /** @param InfosAnomalie[] $listeInfosAnomalies */
  public function __construct(
    public readonly array $listeInfosAnomalies
  ) {}
}
