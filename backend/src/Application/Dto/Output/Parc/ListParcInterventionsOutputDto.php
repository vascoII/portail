<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Parc;

final class ListParcInterventionsOutputDto
{
  public function __construct(
    public readonly array $interventions
  ) {}
}
