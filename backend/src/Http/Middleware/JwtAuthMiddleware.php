<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Domain\Service\Jwt\JwtServiceInterface;
use App\Domain\Service\Redis\RedisServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

final class JwtAuthMiddleware
{
  public function __construct(
    private readonly JwtServiceInterface $jwtService,
    private readonly RedisServiceInterface $redisService
  ) {}

  public function __invoke(Request $request, callable $next): Response
  {
    // Skip authentication for login endpoint
    if ($request->getPathInfo() === '/api/security/login') {
      return $next($request);
    }

    $authHeader = $request->headers->get('Authorization');

    if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
      return new JsonResponse(['error' => 'Missing or invalid authorization header'], 401);
    }

    $token = substr($authHeader, 7); // Remove 'Bearer ' prefix

    $payload = $this->jwtService->validateToken($token);

    if (!$payload) {
      return new JsonResponse(['error' => 'Invalid or expired token'], 401);
    }

    // Get user data from Redis using session ID
    $sessionId = $payload['data']['sessionId'] ?? null;

    if (!$sessionId) {
      return new JsonResponse(['error' => 'Invalid token payload'], 401);
    }

    $user = $this->redisService->getSession($sessionId);

    if (!$user) {
      return new JsonResponse(['error' => 'Session expired or not found'], 401);
    }

    // Add user data to request attributes for use in controllers
    $request->attributes->set('user', $user);
    $request->attributes->set('sessionId', $sessionId);
    $request->attributes->set('jwtPayload', $payload);

    return $next($request);
  }
}
