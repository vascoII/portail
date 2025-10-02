<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Admin;

use App\Domain\Entity\User;
final class UpdateEmailFromPKUserOutputDto
{
  public function __construct(
    public readonly User $user
  ) {}
}
