<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\GestionParc;

final class LeaksOutputDto
{
  /** @param array<int, mixed> $leaks */
  public function __construct(public readonly array $leaks) {}
}
