<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class ListDysfunctionsOutputDto
{
  /** @param array<int, mixed> $dysfunctions */
  public function __construct(public readonly array $dysfunctions) {}
}
