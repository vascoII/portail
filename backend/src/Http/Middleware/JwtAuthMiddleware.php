<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Application\Factory\Security\SecurityOutputFactory;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\Jwt\JwtServiceInterface;
use App\Application\Service\Redis\RedisServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

        // Skip authentication for public endpoint (with or without /api prefix)
        $path = $request->getPathInfo();

        $regexToBypass = [
            '#^/api/security/login$#',
            '#^/security/login$#',
            '#^/api/document/receive$#',
            '#^/document/receive$#',
            '#^/api/releve/create$#',
            '#^/releve/create$#',
            '#^/api/suivi/workorder/\d+$#',
            '#^/suivi/workorder/\d+$#',
            '#^/api/suivi/workorders$#',
            '#^/suivi/workorders$#',
            '#^/api/suivi/workorder/\d+/pdf$#',
            '#^/suivi/workorder/\d+/pdf$#',
            '#^/api/reporttoken/[^/]+$#',
            '#^/reporttoken/[^/]+$#',
        ];

        foreach ($regexToBypass as $pattern) {
            if (preg_match($pattern, $path)) {
                return;
            }
        }

        $authHeader = $request->headers->get('Authorization');

        if (! $authHeader || ! str_starts_with($authHeader, 'Bearer ')) {
            $message = ! $authHeader
              ? 'Authentication token is missing'
              : 'Invalid Authorization header format. Expected: Bearer <token>';

            $this->securityLogger->warning("Authentication failed: {$message}", [
                'route' => $request->attributes->get('_route'),
                'ip' => $request->getClientIp(),
                'error_type' => ! $authHeader ? 'missing_token' : 'invalid_header_format',
            ]);

            $event->setResponse($this->createCorsErrorResponse($message, $request, 401));

            return;
        }

        $token = substr($authHeader, 7); // Remove 'Bearer ' prefix

        $validationResult = $this->jwtService->validateToken($token);

        if (! $validationResult['success']) {
            $errorType = $validationResult['error'];
            $message = $validationResult['message'];
            $code = $validationResult['code'] ?? 'AUTHENTICATION_FAILED';

            $this->securityLogger->warning("Authentication failed: {$message}", [
                'route' => $request->attributes->get('_route'),
                'ip' => $request->getClientIp(),
                'error_type' => $errorType,
                'error_code' => $code,
                'token_prefix' => substr($token, 0, 10) . '...',
            ]);

            $event->setResponse($this->createCorsErrorResponse($message, $request, 401));

            return;
        }

        $payload = $validationResult['payload'];

        // Get user data from Redis using session ID
        $sessionId = $payload['data']['sessionId'] ?? null;

        if (! $sessionId) {
            $this->securityLogger->warning('Authentication failed: Missing session ID in JWT payload', [
                'route' => $request->attributes->get('_route'),
                'ip' => $request->getClientIp(),
                'error_type' => 'missing_session_id',
            ]);

            $event->setResponse($this->createCorsErrorResponse('Authentication token is invalid: missing session information', $request, 401));

            return;
        }

        $sessionDto = $this->redisService->getSession($sessionId);

        if (! $sessionDto || ! $sessionDto->session || ! $sessionDto->session->user) {
            $this->securityLogger->warning('Authentication failed: Session not found in Redis', [
                'route' => $request->attributes->get('_route'),
                'ip' => $request->getClientIp(),
                'session_id_prefix' => substr($sessionId, 0, 8) . '...',
                'error_type' => 'session_not_found',
            ]);

            $event->setResponse($this->createCorsErrorResponse('Authentication session has expired or is invalid', $request, 401));

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

    private function createCorsErrorResponse(string $message, Request $request, int $status = 401): JsonResponse
    {
        $response = new JsonResponse(['success' => false, 'error' => $message], $status);
        $origin = $request->headers->get('Origin');

        if ($origin) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
            $response->headers->set('Access-Control-Allow-Headers', 'Authorization, Content-Type');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
        }

        return $response;
    }
}
