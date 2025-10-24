<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Auth;

use App\Application\Dto\Output\Shared\UserDto;
use App\Application\Service\Auth\AuthServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class AuthService implements AuthServiceInterface
{
    private ?string $sessionId = null;

    private ?UserDto $user = null;

    public function __construct(
        private readonly RequestStack $requestStack
    ) {}

    public function clearAuthenticatedUser(): void
    {
        $this->user = null;
        $this->sessionId = null;
    }

    public function getCurrentSessionId(): ?string
    {
        // First try to get from memory (set by middleware)
        if (null !== $this->sessionId) {
            return $this->sessionId;
        }

        // Fallback to request attributes (for backward compatibility)
        $request = $this->requestStack->getCurrentRequest();
        if (! $request) {
            return null;
        }

        return $request->attributes->get('sessionId');
    }

    public function getCurrentUser(): ?UserDto
    {
        // First try to get from memory (set by middleware)
        if (null !== $this->user) {
            return $this->user;
        }

        // Fallback to request attributes (for backward compatibility)
        $request = $this->requestStack->getCurrentRequest();
        if (! $request) {
            return null;
        }

        return $request->attributes->get('user');
    }

    public function isAuthenticated(): bool
    {
        return null !== $this->getCurrentUser();
    }

    public function setAuthenticatedUser(UserDto $user, string $sessionId): void
    {
        $this->user = $user;
        $this->sessionId = $sessionId;
    }
}
