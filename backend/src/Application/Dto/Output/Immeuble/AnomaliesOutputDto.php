<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class AnomaliesOutputDto
{
  /** @param array<int, mixed> $anomalies */
  public function __construct(public readonly array $anomalies) {}
}
