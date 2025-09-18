<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

final class ViewOutputDto
{
  public function __construct(public readonly array $operator) {}
}
