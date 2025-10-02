<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

use App\Domain\Entity\Occupant4Chgt;

final class SetOccupants4ChgtOutputDto
{
  /** @param Occupant4Chgt[] $occupants */
  public function __construct(
    public readonly array $occupants
  ) {}
}
