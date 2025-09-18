<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class ShowInterventionOutputDto
{
  public function __construct(public readonly string $pkImmeuble, public readonly string $pkIntervention) {}
}
