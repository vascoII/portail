<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Security;

final class ResetPasswordInputDto
{
  public function __construct(public readonly ?string $email = null) {}
}
