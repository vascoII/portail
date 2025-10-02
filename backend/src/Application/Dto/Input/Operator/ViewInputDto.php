<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Operator;

final class ViewInputDto
{
  public function __construct(
    public readonly string $id
  ) {}
}
