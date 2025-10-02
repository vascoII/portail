<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Occupant;

final class ShowInterventionInputDto
{
  public function __construct(
    public readonly string $pkIntervention
  ) {}
}
