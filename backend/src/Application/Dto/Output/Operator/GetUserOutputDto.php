<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

use App\Domain\Entity\User;

final class GetUserOutputDto
{
  
  public function __construct(
    public readonly User $user
  ) {}
}
