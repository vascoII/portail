<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Occupant;

final class ShowRepartReleveOutputDto
{
  public function __construct(public readonly string $pkOccupant, public readonly string $pkImmeuble) {}
}
