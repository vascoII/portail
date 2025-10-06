<?php

declare(strict_types=1);

namespace App\Application\Service\Jwt;

use App\Application\Dto\Output\Security\SessionDto;

interface JwtServiceInterface
{
  public function generateToken(SessionDto $sessionDto): string;

  public function validateToken(string $token): ?array;

  public function getTokenPayload(string $token): ?array;
}
