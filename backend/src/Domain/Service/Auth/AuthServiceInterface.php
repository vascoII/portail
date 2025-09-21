<?php

declare(strict_types=1);

namespace App\Domain\Service\Auth;

use App\Application\Dto\Output\Security\UserDto;

interface AuthServiceInterface
{
  public function getCurrentUser(): ?UserDto;

  public function getCurrentSessionId(): ?string;

  public function isAuthenticated(): bool;
}
