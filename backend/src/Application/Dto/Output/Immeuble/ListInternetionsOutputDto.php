<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

use App\Domain\Entity\Depannage;

final class ListInternetionsOutputDto
{
  /** @param Depannage[] $interventions */
  public function __construct(
    public readonly array $interventions
  ) {}
}
