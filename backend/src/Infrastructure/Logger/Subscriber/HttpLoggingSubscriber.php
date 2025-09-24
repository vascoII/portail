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
 * Centralized HTTP request/response logging
 */
final class HttpLoggingSubscriber implements EventSubscriberInterface
{
  private const STOPWATCH_NAME = 'http_request';
  private const MAX_PAYLOAD_SIZE = 1024; // 1KB max for logged payloads

  public function __construct(
    private readonly LoggerInterface $httpLogger,
    private readonly Stopwatch $stopwatch
  ) {}

  public static function getSubscribedEvents(): array
  {
    return [
      KernelEvents::REQUEST => ['onKernelRequest', 1000],
      KernelEvents::RESPONSE => ['onKernelResponse', -1000],
      KernelEvents::EXCEPTION => ['onKernelException', -1000],
    ];
  }

  public function onKernelRequest(RequestEvent $event): void
  {
    if (!$event->isMainRequest()) {
      return;
    }

    $request = $event->getRequest();

    // Skip non-API requests
    if (!str_starts_with($request->getPathInfo(), '/api/')) {
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

    // Log request body for POST/PUT/PATCH (truncated)
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
    if (!$event->isMainRequest()) {
      return;
    }

    $request = $event->getRequest();
    $response = $event->getResponse();

    // Skip non-API requests
    if (!str_starts_with($request->getPathInfo(), '/api/')) {
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

    // Log response body for errors (truncated)
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

  public function onKernelException(ExceptionEvent $event): void
  {
    if (!$event->isMainRequest()) {
      return;
    }

    $request = $event->getRequest();
    $exception = $event->getThrowable();

    // Skip non-API requests
    if (!str_starts_with($request->getPathInfo(), '/api/')) {
      return;
    }

    $context = [
      'method' => $request->getMethod(),
      'uri' => $request->getUri(),
      'route' => $request->attributes->get('_route', 'unknown'),
      'exception_class' => get_class($exception),
      'exception_message' => $exception->getMessage(),
      'exception_code' => $exception->getCode(),
      'file' => $exception->getFile(),
      'line' => $exception->getLine(),
    ];

    // Add stack trace for 5xx errors
    if ($exception->getCode() >= 500) {
      $context['stack_trace'] = $exception->getTraceAsString();
    }

    $this->httpLogger->error('HTTP Exception occurred', $context);
  }

  private function getClientIp(Request $request): string
  {
    $ip = $request->headers->get('X-Forwarded-For');

    if ($ip) {
      // X-Forwarded-For can contain multiple IPs, take the first one
      $ip = explode(',', $ip)[0];
      $ip = trim($ip);
    }

    if (!$ip) {
      $ip = $request->headers->get('X-Real-IP');
    }

    if (!$ip) {
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
    return json_last_error() === JSON_ERROR_NONE ? $decoded : $json;
  }
}
