<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class GetTableauBordImmeubleOutputDto
{
  public function __construct(
    public readonly TableauDeBordImmeuble $tableauDeBordImmeuble
  ) {}
}
