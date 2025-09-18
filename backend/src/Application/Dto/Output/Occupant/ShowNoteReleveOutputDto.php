<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Occupant;

final class ShowNoteReleveOutputDto
{
  public function __construct(public readonly string $pkOccupant, public readonly string $pkImmeuble, public readonly string $energie) {}
}
