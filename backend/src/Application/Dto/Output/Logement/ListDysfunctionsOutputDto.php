<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class ListDysfunctionsOutputDto
{
  /** @param array<int, mixed> $dysfunctions */
  public function __construct(public readonly array $dysfunctions) {}
}
