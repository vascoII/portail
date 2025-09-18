<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class ShowInterventionOutputDto
{
  public function __construct(public readonly string $pkLogement, public readonly string $pkIntervention) {}
}
