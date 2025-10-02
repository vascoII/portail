<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

use App\Domain\Entity\User;

final class GetChildUsersOutputDto
{
  /** @param User[] $user */
  public function __construct(
    public readonly array $users
  ) {}
}
