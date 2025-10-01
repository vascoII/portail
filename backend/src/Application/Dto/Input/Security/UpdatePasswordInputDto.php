<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Security;

final class UpdatePasswordInputDto 
{
    public function __construct(
        public readonly string $pkUser,
        public readonly string $password 
  ) {}
}
