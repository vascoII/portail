<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

final class GetUserOutputDto
{
  public function __construct(
    public readonly User $user
  ) {}
}
