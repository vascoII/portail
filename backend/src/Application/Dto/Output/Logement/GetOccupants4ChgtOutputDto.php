<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

use App\Application\Dto\Output\Logement\Occupant4ChgtDto;

final class GetOccupants4ChgtOutputDto
{
  public function __construct(
    public readonly array $occupants
  ) {}
}
