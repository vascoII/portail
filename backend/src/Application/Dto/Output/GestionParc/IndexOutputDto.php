<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\GestionParc;

final class IndexOutputDto
{
  /** @param array<int, mixed> $items */
  public function __construct(public readonly array $items) {}
}
