<?php

declare(strict_types=1);

namespace App\Application\Service\Auth;

use App\Application\Dto\Output\Shared\UserDto;

interface AuthServiceInterface
{
  public function setAuthenticatedUser(UserDto $user, string $sessionId): void;

  public function clearAuthenticatedUser(): void;

  public function getCurrentUser(): ?UserDto;

  public function getCurrentSessionId(): ?string;

  public function isAuthenticated(): bool;
}
