<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Security;

final class LoginInputDto
{
  public function __construct(public readonly ?string $username = null, public readonly ?string $password = null) {}
}
