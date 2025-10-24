<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Session
{
    public function __construct(
        public readonly ?bool $connected,
        public readonly ?string $sessionId,
        public readonly ?User $user
    ) {}
}
