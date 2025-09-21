<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Auth;

use App\Application\Dto\Output\Security\UserDto;
use App\Domain\Service\Auth\AuthServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class AuthService implements AuthServiceInterface
{
  public function __construct(
    private readonly RequestStack $requestStack
  ) {}

  public function getCurrentUser(): ?UserDto
  {
    $request = $this->requestStack->getCurrentRequest();

    if (!$request) {
      return null;
    }

    return $request->attributes->get('user');
  }

  public function getCurrentSessionId(): ?string
  {
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
}
