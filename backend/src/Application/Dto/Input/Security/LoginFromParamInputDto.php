<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Security;

final class LoginFromParamInputDto
{
    public function __construct(
        public readonly ?string $username = null,
        public readonly ?string $password = null,
        public readonly ?string $param = null
    ) {}
}
