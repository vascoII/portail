<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Operator;

final class DeleteUserInpuDto
{
  public function __construct(
    public readonly int $pkUser
  ) {}
}
