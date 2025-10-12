<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Ocupant;

use App\Domain\Entity\Occupant;

final class GetOccupantOutputDto
{
  public function __construct(
    public readonly Occupant $occupant
  ) {}
}
