<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\GestionParc;

final class FilterResultOutputDto
{
  /** @param array<int, mixed> $results */
  public function __construct(public readonly array $results) {}
}
