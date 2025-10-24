<?php

declare(strict_types=1);

namespace App\Http\EventListener;

use App\Http\Exception\AuthorizationException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Rate limiting listener that implements basic rate limiting for API endpoints.
 */
final class RateLimitListener implements EventSubscriberInterface
{
    private array $lastReset = [];

    private array $requestCounts = [];

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly int $defaultLimit = 100,
        private readonly int $defaultWindow = 3600, // 1 hour
        private readonly array $endpointLimits = [],
        private readonly bool $enableRateLimiting = true
    ) {}

    /**
     * Get current request count for client and endpoint.
     */
    public function getCurrentCount(string $clientId, string $endpoint): int
    {
        $key = "{$clientId}:{$endpoint}";

        return $this->requestCounts[$key] ?? 0;
    }

    /**
     * Get rate limit status for client and endpoint.
     */
    public function getRateLimitStatus(string $clientId, string $endpoint): array
    {
        $key = "{$clientId}:{$endpoint}";
        $limit = $this->getLimitForEndpoint($endpoint);
        $window = $this->getWindowForEndpoint($endpoint);
        $current = $this->requestCounts[$key] ?? 0;
        $resetTime = $this->lastReset[$key] ?? time();

        return [
            'limit' => $limit,
            'current' => $current,
            'remaining' => max(0, $limit - $current),
            'reset_time' => $resetTime + $window,
            'window' => $window,
        ];
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 100],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        // Skip non-API requests
        if (! str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }

        // Skip if rate limiting is disabled
        if (! $this->enableRateLimiting) {
            return;
        }

        // Skip OPTIONS requests (CORS preflight)
        if ('OPTIONS' === $request->getMethod()) {
            return;
        }

        $this->checkRateLimit($event, $request);
    }

    /**
     * Reset rate limit for client and endpoint.
     */
    public function resetRateLimit(string $clientId, string $endpoint): void
    {
        $key = "{$clientId}:{$endpoint}";
        unset($this->requestCounts[$key], $this->lastReset[$key]);
    }

    /**
     * Check rate limit for the request.
     */
    private function checkRateLimit(RequestEvent $event, Request $request): void
    {
        $clientId = $this->getClientId($request);
        $endpoint = $this->getEndpoint($request);
        $limit = $this->getLimitForEndpoint($endpoint);
        $window = $this->getWindowForEndpoint($endpoint);

        $key = "{$clientId}:{$endpoint}";
        $now = time();

        // Reset counters if window has expired
        if (! isset($this->lastReset[$key]) || ($now - $this->lastReset[$key]) >= $window) {
            $this->requestCounts[$key] = 0;
            $this->lastReset[$key] = $now;
        }

        // Increment request count
        $this->requestCounts[$key] = ($this->requestCounts[$key] ?? 0) + 1;

        // Check if limit exceeded
        if ($this->requestCounts[$key] > $limit) {
            $this->logRateLimitExceeded($clientId, $endpoint, $limit, $window);

            $exception = AuthorizationException::rateLimited($endpoint, $limit, $window);
            $event->setResponse(new Response(
                json_encode($exception->toApiResponse()),
                $exception->getStatusCode(),
                array_merge(
                    ['Content-Type' => 'application/json'],
                    $exception->getHeaders()
                )
            ));
        }
    }

    /**
     * Get client identifier for rate limiting.
     */
    private function getClientId(Request $request): string
    {
        // Try to get user ID from JWT if available
        $user = $request->attributes->get('_user');
        if ($user && isset($user['id'])) {
            return 'user:' . $user['id'];
        }

        // Fall back to IP address
        return 'ip:' . $request->getClientIp();
    }

    /**
     * Get endpoint identifier for rate limiting.
     */
    private function getEndpoint(Request $request): string
    {
        $route = $request->attributes->get('_route', 'unknown');
        $method = $request->getMethod();

        return "{$method}:{$route}";
    }

    /**
     * Get rate limit for specific endpoint.
     */
    private function getLimitForEndpoint(string $endpoint): int
    {
        return $this->endpointLimits[$endpoint]['limit'] ?? $this->defaultLimit;
    }

    /**
     * Get time window for specific endpoint.
     */
    private function getWindowForEndpoint(string $endpoint): int
    {
        return $this->endpointLimits[$endpoint]['window'] ?? $this->defaultWindow;
    }

    /**
     * Log rate limit exceeded event.
     */
    private function logRateLimitExceeded(string $clientId, string $endpoint, int $limit, int $window): void
    {
        $this->logger->warning('Rate limit exceeded', [
            'client_id' => $clientId,
            'endpoint' => $endpoint,
            'limit' => $limit,
            'window' => $window,
            'current_count' => $this->requestCounts["{$clientId}:{$endpoint}"] ?? 0,
        ]);
    }
}
