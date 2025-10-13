<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

use App\Domain\Entity\Logement;

final class ListLogementsOuputDto
{
  /** @param Logement[] $listLogementDto */
  public function __construct(
    public readonly array $listLogementDto
  ) {}
}
