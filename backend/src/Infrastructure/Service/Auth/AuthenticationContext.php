<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Auth;

final class AuthenticationContext
{
  public function __construct(
    public readonly string $sessionId,
    public readonly int $pkUser
  ) {}

  public static function fromHeaders(array $headers): self
  {
    $sessionId = $headers['X-Session-ID'] ?? $headers['x-session-id'] ?? '';
    $pkUser = (int) ($headers['X-User-ID'] ?? $headers['x-user-id'] ?? 0);

    if (empty($sessionId) || $pkUser <= 0) {
      throw new \InvalidArgumentException('Missing required authentication headers: X-Session-ID and X-User-ID');
    }

    return new self($sessionId, $pkUser);
  }
}
