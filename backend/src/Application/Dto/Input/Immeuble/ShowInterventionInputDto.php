<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Immeuble;

final class ShowInterventionInputDto
{
  public function __construct(public readonly string $pkImmeuble, public readonly string $pkIntervention) {}
}
