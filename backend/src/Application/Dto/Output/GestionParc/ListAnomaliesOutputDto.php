<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\GestionParc;

final class ListAnomaliesOutputDto
{
  /** @param array<int, mixed> $anomalies */
  public function __construct(public readonly array $anomalies) {}
}
