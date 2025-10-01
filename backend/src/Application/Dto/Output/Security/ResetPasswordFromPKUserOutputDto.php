<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Security;

final class ResetPasswordFromPKUserOutputDto
{
  public function __construct(
    public readonly User $user
  ) {}
}
