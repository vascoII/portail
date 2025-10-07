<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Application\Service\Jwt\JwtServiceInterface;
use App\Application\Service\Redis\RedisServiceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Factory\Security\SecurityOutputFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class JwtAuthMiddleware
{
  public function __construct(
    private readonly JwtServiceInterface $jwtService,
    private readonly RedisServiceInterface $redisService,
    private readonly AuthServiceInterface $authService,
    private readonly SecurityOutputFactory $outputFactory,
    private readonly LoggerInterface $securityLogger
  ) {}

  public function __invoke(RequestEvent $event): void
  {
    $request = $event->getRequest();

    // Skip authentication for public login endpoint (with or without /api prefix)
    $path = $request->getPathInfo();
    if ($path === '/security/login' || $path === '/api/security/login') {
      return;
    }

    $authHeader = $request->headers->get('Authorization');

    if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
      $this->securityLogger->warning('Authentication failed: Missing or invalid Authorization header', [
        'route' => $request->attributes->get('_route'),
        'ip' => $request->getClientIp(),
      ]);

      $event->setResponse(new JsonResponse(['success' => false, 'error' => 'User not authenticated'], 401));
      return;
    }

    $token = substr($authHeader, 7); // Remove 'Bearer ' prefix

    $payload = $this->jwtService->validateToken($token);

    if (!$payload) {
      $this->securityLogger->warning('Authentication failed: Invalid JWT token', [
        'route' => $request->attributes->get('_route'),
        'ip' => $request->getClientIp(),
        'token_prefix' => substr($token, 0, 10) . '...',
      ]);

      $event->setResponse(new JsonResponse(['success' => false, 'error' => 'User not authenticated'], 401));
      return;
    }

    // Get user data from Redis using session ID
    $sessionId = $payload['data']['sessionId'] ?? null;

    if (!$sessionId) {
      $this->securityLogger->warning('Authentication failed: Missing session ID in JWT payload', [
        'route' => $request->attributes->get('_route'),
        'ip' => $request->getClientIp(),
      ]);

      $event->setResponse(new JsonResponse(['success' => false, 'error' => 'User not authenticated'], 401));
      return;
    }

    $sessionDto = $this->redisService->getSession($sessionId);

    if (!$sessionDto || !$sessionDto->session || !$sessionDto->session->user) {
      $this->securityLogger->warning('Authentication failed: Session not found in Redis', [
        'route' => $request->attributes->get('_route'),
        'ip' => $request->getClientIp(),
        'session_id_prefix' => substr($sessionId, 0, 8) . '...',
      ]);

      $event->setResponse(new JsonResponse(['success' => false, 'error' => 'User not authenticated'], 401));
      return;
    }

    $userDto = $this->outputFactory->createUserDto($sessionDto->session->user);  

    // Set the authenticated user in the AuthService
    $this->authService->setAuthenticatedUser($userDto, $sessionId);

    $this->securityLogger->debug('Authentication successful', [
      'route' => $request->attributes->get('_route'),
      'user_id' => $sessionDto->session->user->pkUser,
      'user_name' => $sessionDto->session->user->userName,
    ]);
  }
}
