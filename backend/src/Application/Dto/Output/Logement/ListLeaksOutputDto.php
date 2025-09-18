<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class ListLeaksOutputDto
{
  /** @param array<int, mixed> $leaks */
  public function __construct(public readonly array $leaks) {}
}
