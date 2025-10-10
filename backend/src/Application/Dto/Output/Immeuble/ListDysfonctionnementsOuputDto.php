<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

use App\Domain\Entity\Immeuble;

final class ListDysfonctionnementsOuputDto
{
  /** @param Immeuble[] $immeubleDto */
  public function __construct(
    public readonly array $immeubleDto
  ) {}
}
