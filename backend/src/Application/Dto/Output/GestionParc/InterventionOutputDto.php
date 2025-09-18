<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\GestionParc;

final class InterventionOutputDto
{
  /** @param array<int, mixed> $data */
  public function __construct(public readonly array $data) {}
}
