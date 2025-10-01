<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Admin;

final class ResetPasswordFromEmailInputDto
{
  public function __construct(
    public readonly int $email
  ) {}
}
