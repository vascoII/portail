<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Security;

use App\Application\Dto\Output\Security\UserDto;

final class ResetPasswordFromPKUserOutputDto
{
  public function __construct(
    public readonly UserDto $user
  ) {}
}
