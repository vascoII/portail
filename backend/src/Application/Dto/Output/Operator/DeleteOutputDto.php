<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

final class DeleteOutputDto
{
  public function __construct(public readonly bool $deleted) {}
}
