<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\GestionParc;

final class DysfunctionsOutputDto
{
  /** @param array<int, mixed> $dysfunctions */
  public function __construct(public readonly array $dysfunctions) {}
}
