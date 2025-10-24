<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Security;

final class UpdateEmailFromPKUserInputDto
{
  public function __construct(
    public readonly int $pkUser,
    public readonly string $email
  ) {}
}
