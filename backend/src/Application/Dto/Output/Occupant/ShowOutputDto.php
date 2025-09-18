<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Occupant;

final class ShowOutputDto
{
  /** @param array<int, mixed> $data */
  public function __construct(public readonly array $data) {}
}
