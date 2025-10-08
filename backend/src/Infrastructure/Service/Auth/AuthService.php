<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Auth;

use App\Application\Dto\Output\Shared\UserDto;
use App\Application\Service\Auth\AuthServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class AuthService implements AuthServiceInterface
{
  private ?UserDto $user = null;
  private ?string $sessionId = null;

  public function __construct(
    private readonly RequestStack $requestStack
  ) {}

  public function setAuthenticatedUser(UserDto $user, string $sessionId): void
  {
    $this->user = $user;
    $this->sessionId = $sessionId;
  }

  public function getCurrentUser(): ?UserDto
  {
    // First try to get from memory (set by middleware)
    if ($this->user !== null) {
      return $this->user;
    }

    // Fallback to request attributes (for backward compatibility)
    $request = $this->requestStack->getCurrentRequest();
    if (!$request) {
      return null;
    }

    return $request->attributes->get('user');
  }

  public function getCurrentSessionId(): ?string
  {
    // First try to get from memory (set by middleware)
    if ($this->sessionId !== null) {
      return $this->sessionId;
    }

    // Fallback to request attributes (for backward compatibility)
    $request = $this->requestStack->getCurrentRequest();
    if (!$request) {
      return null;
    }

    return $request->attributes->get('sessionId');
  }

  public function isAuthenticated(): bool
  {
    return $this->getCurrentUser() !== null;
  }

  public function clearAuthenticatedUser(): void
  {
    $this->user = null;
    $this->sessionId = null;
  }
}
