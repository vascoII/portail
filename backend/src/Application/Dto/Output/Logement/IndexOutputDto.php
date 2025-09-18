<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class IndexOutputDto
{
  /** @param array<int, mixed> $logements */
  public function __construct(public readonly array $logements) {}
}
