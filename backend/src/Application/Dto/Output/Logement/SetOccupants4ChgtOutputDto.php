<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class SetOccupants4ChgtOutputDto
{
  /** @param Occupant4Chgt[] $occupants */
  public function __construct(
    public readonly array $occupants
  ) {}
}
