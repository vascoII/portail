<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

use App\Domain\Entity\TableauDeBordLogement;

final class GetTableauBordLogementOutputDto
{
  public function __construct(
    public readonly TableauDeBordLogement $tableauDeBordLogement
  ) {}
}
