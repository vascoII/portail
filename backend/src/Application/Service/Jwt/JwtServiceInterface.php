<?php

declare(strict_types=1);

namespace App\Application\Service\Jwt;

use App\Application\Dto\Output\Shared\SessionDto;

interface JwtServiceInterface
{
    public function generateToken(SessionDto $sessionDto): string;

    public function getTokenPayload(string $token): ?array;

    public function validateToken(string $token): ?array;
}
