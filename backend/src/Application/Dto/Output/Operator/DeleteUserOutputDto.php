<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

final class DeleteUserOutputDto
{
  public function __construct(
    public readonly string $error,
    public readonly string $info
  ) {}
}
