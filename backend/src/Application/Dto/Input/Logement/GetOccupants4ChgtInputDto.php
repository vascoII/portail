<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class GetOccupants4ChgtInputDto
{
  public function __construct(
    public readonly int $pkImmeuble,
    public readonly int $pkOccupant,
    public readonly bool $IsNew,
  ) {}
}