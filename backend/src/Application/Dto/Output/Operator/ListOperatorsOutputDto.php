<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

use App\Application\Dto\Output\Shared\UserDto;

final class ListOperatorsOutputDto
{
  /** @param UserDto[] $userDto */
  public function __construct(
    public readonly array $userDto
  ) {}
}
