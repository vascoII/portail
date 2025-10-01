<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Admin;

use App\Application\Dto\Output\Security\UserDto;

final class UpdateEmailFromPKUserOutputDto
{
  public function __construct(
    public readonly UserDto $user
  ) {}
}
