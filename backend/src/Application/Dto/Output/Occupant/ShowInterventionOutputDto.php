<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Occupant;

final class ShowInterventionOutputDto
{
  public function __construct(public readonly string $pkIntervention) {}
}
