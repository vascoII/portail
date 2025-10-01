<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\TableauBordClient;

final class GetTableauBordClientOutputDto
{
  public function __construct(
    public readonly object $tableauDeBordClient
  ) {}
}
