<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Occupant;

use App\Domain\Entity\Occupant;

final class GetOccupantAccountOutputDto
{
  public function __construct(
    public readonly Occupant $occupantAccount
  ) {}
}
