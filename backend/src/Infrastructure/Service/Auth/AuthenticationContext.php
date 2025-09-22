<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Auth;

use App\Domain\Service\Auth\AuthServiceInterface;

/**
 * Temporary compatibility class for existing code
 * This will be removed once all services are migrated to use AuthService directly
 */
final class AuthenticationContext
{
  public function __construct(
    public readonly string $sessionId,
    public readonly int $pkUser
  ) {}

  /**
   * Create AuthenticationContext from current authenticated user
   * This is a temporary bridge to existing code
   */
  public static function fromAuthService(AuthServiceInterface $authService): self
  {
    $user = $authService->getCurrentUser();
    $sessionId = $authService->getCurrentSessionId();
    
    if (!$user || !$sessionId) {
      throw new \RuntimeException('User not authenticated');
    }

    return new self($sessionId, $user->pkUser);
  }

  /**
   * Legacy method for backward compatibility
   */
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
