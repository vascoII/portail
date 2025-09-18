<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\GestionParc;

final class ListInterventionsOutputDto
{
  /** @param array<int, mixed> $interventions */
  public function __construct(public readonly array $interventions) {}
}
