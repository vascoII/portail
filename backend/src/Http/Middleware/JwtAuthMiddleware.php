<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Domain\Service\Jwt\JwtServiceInterface;
use App\Domain\Service\Redis\RedisServiceInterface;
use App\Domain\Service\Auth\AuthServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class JwtAuthMiddleware
{
  public function __construct(
    private readonly JwtServiceInterface $jwtService,
    private readonly RedisServiceInterface $redisService,
    private readonly AuthServiceInterface $authService
  ) {}

  public function __invoke(RequestEvent $event): void
  {
    $request = $event->getRequest();

    // Skip authentication for login endpoint
    if ($request->getPathInfo() === '/api/security/login') {
      return;
    }

    $authHeader = $request->headers->get('Authorization');

    if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
      $event->setResponse(new JsonResponse(['success' => false, 'error' => 'User not authenticated'], 401));
      return;
    }

    $token = substr($authHeader, 7); // Remove 'Bearer ' prefix

    $payload = $this->jwtService->validateToken($token);

    if (!$payload) {
      $event->setResponse(new JsonResponse(['success' => false, 'error' => 'User not authenticated'], 401));
      return;
    }

    // Get user data from Redis using session ID
    $sessionId = $payload['data']['sessionId'] ?? null;

    if (!$sessionId) {
      $event->setResponse(new JsonResponse(['success' => false, 'error' => 'User not authenticated'], 401));
      return;
    }

    $user = $this->redisService->getSession($sessionId);

    if (!$user) {
      $event->setResponse(new JsonResponse(['success' => false, 'error' => 'User not authenticated'], 401));
      return;
    }

    // Set the authenticated user in the AuthService
    $this->authService->setAuthenticatedUser($user, $sessionId);
  }
}
