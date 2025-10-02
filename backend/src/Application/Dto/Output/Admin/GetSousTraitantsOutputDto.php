<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Admin;

use App\Domain\Entity\SousTraitant;

final class GetSousTraitantsOutputDto
{
  /** @param SousTraitant[] $sousTraitants */
  public function __construct(
    public readonly array $sousTraitants
  ) {}
}
