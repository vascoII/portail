<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class InfosFuites
{
  /** @param InfosFuite[] $listeInfosFuites */
  public function __construct(
    public readonly array $listeInfosFuites
  ) {}
}
