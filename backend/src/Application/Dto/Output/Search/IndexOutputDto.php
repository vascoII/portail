<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Search;

final class IndexOutputDto
{
  /** @param array<int, mixed> $results */
  public function __construct(public readonly array $results) {}
}
