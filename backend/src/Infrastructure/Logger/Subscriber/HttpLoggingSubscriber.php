<?php

declare(strict_types=1);

namespace App\Infrastructure\Logger\Subscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * Centralized HTTP request/response logging.
 *
 * This subscriber works in conjunction with the new HTTP event listeners:
 * - RequestIdListener: Handles request ID generation
 * - ResponseTimeListener: Handles response time measurement
 * - GlobalExceptionListener: Handles exception logging
 *
 * This subscriber focuses on detailed request/response logging with payloads.
 */
final class HttpLoggingSubscriber implements EventSubscriberInterface
{
    private const MAX_PAYLOAD_SIZE = 1024; // 1KB max for logged payloads
    private const STOPWATCH_NAME = 'http_request';

    public function __construct(
        private readonly LoggerInterface $httpLogger,
        private readonly Stopwatch $stopwatch
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 1000],
            KernelEvents::RESPONSE => ['onKernelResponse', -1000],
            // Note: Exception logging is now handled by GlobalExceptionListener
        ];
    }

    /**
     * Note: Exception logging is now handled by GlobalExceptionListener
     * This method is kept for backward compatibility but is not used.
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        // Exception logging is now handled by GlobalExceptionListener
        // which provides better integration with the exception hierarchy
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (! $event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();

        // Skip non-API requests
        if (! str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }

        $this->stopwatch->start(self::STOPWATCH_NAME);

        $context = [
            'method' => $request->getMethod(),
            'uri' => $request->getUri(),
            'route' => $request->attributes->get('_route', 'unknown'),
            'client_ip' => $this->getClientIp($request),
            'user_agent' => $request->headers->get('User-Agent'),
            'content_type' => $request->headers->get('Content-Type'),
            'content_length' => $request->headers->get('Content-Length'),
        ];

        // Add request ID if available (from RequestIdListener)
        $requestId = $request->attributes->get('request_id');
        if ($requestId) {
            $context['request_id'] = $requestId;
        }

        // Log request body for POST/PUT/PATCH (truncated and sanitized)
        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true)) {
            $body = $request->getContent();
            if ($body) {
                $context['request_body_size'] = strlen($body);
                if (strlen($body) <= self::MAX_PAYLOAD_SIZE) {
                    $context['request_body'] = $this->safeJsonDecode($body);
                } else {
                    $context['request_body'] = '[TRUNCATED - ' . strlen($body) . ' bytes]';
                }
            }
        }

        $this->httpLogger->info('HTTP Request received', $context);
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        if (! $event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();
        $response = $event->getResponse();

        // Skip non-API requests
        if (! str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }

        $stopwatchEvent = $this->stopwatch->stop(self::STOPWATCH_NAME);
        $duration = $stopwatchEvent ? $stopwatchEvent->getDuration() : 0;

        $context = [
            'method' => $request->getMethod(),
            'uri' => $request->getUri(),
            'route' => $request->attributes->get('_route', 'unknown'),
            'status_code' => $response->getStatusCode(),
            'duration_ms' => $duration,
            'response_size' => strlen($response->getContent()),
            'memory_usage' => memory_get_usage(true),
            'memory_peak' => memory_get_peak_usage(true),
        ];

        // Add request ID if available (from RequestIdListener)
        $requestId = $request->attributes->get('request_id');
        if ($requestId) {
            $context['request_id'] = $requestId;
        }

        // Log response body for errors (truncated and sanitized)
        if ($response->getStatusCode() >= 400) {
            $body = $response->getContent();
            if ($body) {
                if (strlen($body) <= self::MAX_PAYLOAD_SIZE) {
                    $context['response_body'] = $this->safeJsonDecode($body);
                } else {
                    $context['response_body'] = '[TRUNCATED - ' . strlen($body) . ' bytes]';
                }
            }
        }

        // Determine log level based on status code
        $level = $this->getLogLevel($response->getStatusCode());

        $this->httpLogger->log($level, 'HTTP Response sent', $context);
    }

    private function getClientIp(Request $request): string
    {
        $ip = $request->headers->get('X-Forwarded-For');

        if ($ip) {
            // X-Forwarded-For can contain multiple IPs, take the first one
            $ip = explode(',', $ip)[0];
            $ip = trim($ip);
        }

        if (! $ip) {
            $ip = $request->headers->get('X-Real-IP');
        }

        if (! $ip) {
            $ip = $request->getClientIp();
        }

        return $ip ?: 'unknown';
    }

    private function getLogLevel(int $statusCode): string
    {
        return match (true) {
            $statusCode >= 500 => 'error',
            $statusCode >= 400 => 'warning',
            $statusCode >= 300 => 'info',
            default => 'info',
        };
    }

    private function safeJsonDecode(string $json): mixed
    {
        $decoded = json_decode($json, true);

        return JSON_ERROR_NONE === json_last_error() ? $decoded : $json;
    }
}
