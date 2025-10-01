<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class GetTableauBordLogementInputDto
{
  public function __construct(
    public readonly int $pkLogement,
    public readonly int $pkOccupant
  ) {}
}
