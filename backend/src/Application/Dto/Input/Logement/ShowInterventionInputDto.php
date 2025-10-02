<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class ShowInterventionInputDto
{
  public function __construct(
    public readonly string $pkLogement,
    public readonly string $pkIntervention
  ) {}
}
