<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Jwt;

use App\Application\Dto\Output\Shared\SessionDto;
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

  public function validateToken(string $token): array
  {
    try {
      $decoded = JWT::decode($token, new Key($this->jwtSecret, self::ALGORITHM));
      return [
        'success' => true,
        'payload' => json_decode(json_encode($decoded), true)
      ];
    } catch (\Firebase\JWT\ExpiredException $e) {
      return [
        'success' => false,
        'error' => 'expired',
        'message' => 'Authentication token has expired',
        'code' => 'TOKEN_EXPIRED'
      ];
    } catch (\Firebase\JWT\SignatureInvalidException $e) {
      return [
        'success' => false,
        'error' => 'invalid_signature',
        'message' => 'Authentication token has invalid signature',
        'code' => 'INVALID_SIGNATURE'
      ];
    } catch (\Firebase\JWT\BeforeValidException $e) {
      return [
        'success' => false,
        'error' => 'not_yet_valid',
        'message' => 'Authentication token is not yet valid',
        'code' => 'TOKEN_NOT_YET_VALID'
      ];
    } catch (\InvalidArgumentException $e) {
      return [
        'success' => false,
        'error' => 'malformed',
        'message' => 'Authentication token is malformed',
        'code' => 'MALFORMED_TOKEN'
      ];
    } catch (\Exception $e) {
      return [
        'success' => false,
        'error' => 'validation_failed',
        'message' => 'Authentication token validation failed',
        'code' => 'VALIDATION_FAILED'
      ];
    }
  }

  public function getTokenPayload(string $token): ?array
  {
    $result = $this->validateToken($token);
    return $result['success'] ? $result['payload']['data'] : null;
  }
}
