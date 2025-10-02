<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Occupant;

final class ShowNoteReleveInputDto
{
  public function __construct(
    public readonly string $pkOccupant,
    public readonly string $pkImmeuble,
    public readonly string $energie
  ) {}
}
