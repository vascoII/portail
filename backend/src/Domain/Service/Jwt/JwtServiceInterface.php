<?php

declare(strict_types=1);

namespace App\Domain\Service\Jwt;

use App\Application\Dto\Output\Security\UserDto;

interface JwtServiceInterface
{
  public function generateToken(UserDto $user, string $sessionId): string;

  public function validateToken(string $token): ?array;

  public function getTokenPayload(string $token): ?array;
}
