<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

use App\Application\Dto\Output\Security\UserDto;

final class GetUserOutputDto
{
  public function __construct(
    public readonly UserDto $user
  ) {}
}
