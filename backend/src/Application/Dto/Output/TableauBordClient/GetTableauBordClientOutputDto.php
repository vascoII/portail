<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\TableauBordClient;

use App\Domain\Entity\TableauDeBordClient;

final class GetTableauBordClientOutputDto
{
  public function __construct(
    public readonly TableauDeBordClient $tableauDeBordClient
  ) {}
}
