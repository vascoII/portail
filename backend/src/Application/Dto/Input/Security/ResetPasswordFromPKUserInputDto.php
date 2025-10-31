<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Security;

final class ResetPasswordFromPKUserInputDto
{
    public function __construct(
        public readonly int $pkUser
    ) {}
}
