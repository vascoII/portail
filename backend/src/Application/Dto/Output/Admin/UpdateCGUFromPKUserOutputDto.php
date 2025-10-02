<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Admin;

use App\Domain\Entity\User;

final class UpdateCGUFromPKUserOutputDto
{
  public function __construct(
    public readonly User $user
  ) {}
}
