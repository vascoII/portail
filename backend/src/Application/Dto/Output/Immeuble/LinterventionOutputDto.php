<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class LinterventionOutputDto
{
  /** @param array<int, mixed> $data */
  public function __construct(public readonly array $data) {}
}
