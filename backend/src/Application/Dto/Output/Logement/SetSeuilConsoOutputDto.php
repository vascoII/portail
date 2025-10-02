<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

use App\Domain\Entity\Retour;

final class SetSeuilConsoOutputDto
{
  public function __construct(
    public readonly Retour $retour
  ) {}
}
