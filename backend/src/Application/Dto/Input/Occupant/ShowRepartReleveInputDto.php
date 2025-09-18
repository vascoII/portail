<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Occupant;

final class ShowRepartReleveInputDto
{
  public function __construct(public readonly string $pkOccupant, public readonly string $pkImmeuble) {}
}
