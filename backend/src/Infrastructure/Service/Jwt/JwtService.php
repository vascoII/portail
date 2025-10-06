<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Jwt;

use App\Application\Dto\Output\Security\SessionDto;
use App\Application\Service\Jwt\JwtServiceInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

final class JwtService implements JwtServiceInterface
{
  private const ALGORITHM = 'HS256';
  private const EXPIRATION_TIME = 3600; // 1 hour

  public function __construct(
    private readonly string $jwtSecret,
    private readonly int $jwtExpiration = self::EXPIRATION_TIME
  ) {}

  public function generateToken(SessionDto $sessionDto): string
  {
    $now = time();
    $payload = [
      'iss' => 'techem-portail', // Issuer
      'aud' => 'techem-client', // Audience
      'iat' => $now, // Issued at
      'exp' => $now + $this->jwtExpiration, // Expiration
      'sub' => (string) $sessionDto->session->user->pkUser, // Subject (user ID)
      'data' => [
        'sessionId' => (string) $sessionDto->session->sessionId,
        'userName' => (string) $sessionDto->session->user->userName,
        'loginId' => (string) $sessionDto->session->user->loginId,
        'userType' => (string) $sessionDto->session->user->userType,
        'clientId' => (string) $sessionDto->session->user->clientId,
        'fkClient' => (int) $sessionDto->session->user->fkClient,
        'userRole' => (string) $sessionDto->session->user->userRole
      ]
    ];

    return JWT::encode($payload, $this->jwtSecret, self::ALGORITHM);
  }

  public function validateToken(string $token): ?array
  {
    try {
      $decoded = JWT::decode($token, new Key($this->jwtSecret, self::ALGORITHM));
      return json_decode(json_encode($decoded), true);
    } catch (\Exception $e) {
      return null;
    }
  }

  public function getTokenPayload(string $token): ?array
  {
    $decoded = $this->validateToken($token);
    return $decoded ? $decoded['data'] : null;
  }
}
