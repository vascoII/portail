<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

final class IndexOutputDto
{
  public function __construct(public readonly array $operators) {}
}

