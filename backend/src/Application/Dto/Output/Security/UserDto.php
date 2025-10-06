<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Security;

use App\Domain\Entity\User;

final class UserDto
{
  public function __construct(
    public readonly User $user
  ) {}
}
