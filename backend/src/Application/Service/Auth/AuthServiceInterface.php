<?php

declare(strict_types=1);

namespace App\Application\Service\Auth;

use App\Application\Dto\Output\Shared\UserDto;

interface AuthServiceInterface
{
    public function clearAuthenticatedUser(): void;

    public function getCurrentSessionId(): ?string;

    public function getCurrentUser(): ?UserDto;

    public function isAuthenticated(): bool;

    public function setAuthenticatedUser(UserDto $user, string $sessionId): void;
}
