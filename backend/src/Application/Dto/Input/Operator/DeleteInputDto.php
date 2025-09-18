<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Operator;

final class DeleteInputDto
{
  public function __construct(public readonly string $operatorId) {}
}
