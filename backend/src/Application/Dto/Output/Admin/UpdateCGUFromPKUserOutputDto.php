<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Admin;

final class UpdateCGUFromPKUserOutputDto
{
  public function __construct(
    public readonly User $user
  ) {}
}
