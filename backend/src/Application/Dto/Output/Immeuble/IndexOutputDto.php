<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class IndexOutputDto
{
  /** @param array<int, mixed> $immeubles */
  public function __construct(public readonly array $immeubles) {}
}
