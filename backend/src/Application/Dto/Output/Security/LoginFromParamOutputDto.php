<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Security;

final class LoginFromParamOutputDto
{
  public function __construct(
    public readonly bool $success,
    public readonly ?string $jwt = null,
    public readonly ?string $userName = null,
    public readonly ?string $error = null
  ) {}
}
