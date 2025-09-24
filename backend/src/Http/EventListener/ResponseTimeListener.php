<?php

declare(strict_types=1);

namespace App\Http\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Response time listener that measures and logs request processing time
 */
final class ResponseTimeListener implements EventSubscriberInterface
{
  private array $startTimes = [];

  public function __construct(
    private readonly LoggerInterface $logger,
    private readonly float $slowRequestThreshold = 1.0, // 1 second
    private readonly bool $enableResponseTimeLogging = true
  ) {}

  public static function getSubscribedEvents(): array
  {
    return [
      KernelEvents::REQUEST => ['onKernelRequest', -1000],
      KernelEvents::RESPONSE => ['onKernelResponse', 1000],
    ];
  }

  public function onKernelRequest(RequestEvent $event): void
  {
    $request = $event->getRequest();

    // Skip non-API requests
    if (!str_starts_with($request->getPathInfo(), '/api/')) {
      return;
    }

    // Skip if response time logging is disabled
    if (!$this->enableResponseTimeLogging) {
      return;
    }

    // Store start time
    $requestId = $request->attributes->get('request_id', 'unknown');
    $this->startTimes[$requestId] = microtime(true);
  }

  public function onKernelResponse(ResponseEvent $event): void
  {
    $request = $event->getRequest();
    $response = $event->getResponse();

    // Skip non-API requests
    if (!str_starts_with($request->getPathInfo(), '/api/')) {
      return;
    }

    // Skip if response time logging is disabled
    if (!$this->enableResponseTimeLogging) {
      return;
    }

    $requestId = $request->attributes->get('request_id', 'unknown');
    $startTime = $this->startTimes[$requestId] ?? null;

    if ($startTime) {
      $responseTime = microtime(true) - $startTime;
      $this->logResponseTime($request, $response, $responseTime);

      // Add response time to response headers
      $response->headers->set('X-Response-Time', sprintf('%.3f', $responseTime));

      // Clean up
      unset($this->startTimes[$requestId]);
    }
  }

  /**
   * Log response time
   */
  private function logResponseTime(Request $request, Response $response, float $responseTime): void
  {
    $context = [
      'request_method' => $request->getMethod(),
      'request_uri' => $request->getUri(),
      'request_route' => $request->attributes->get('_route', 'unknown'),
      'response_status' => $response->getStatusCode(),
      'response_time' => $responseTime,
      'client_ip' => $request->getClientIp(),
      'user_agent' => $request->headers->get('User-Agent'),
    ];

    // Add request ID if available
    $requestId = $request->attributes->get('request_id');
    if ($requestId) {
      $context['request_id'] = $requestId;
    }

    // Add user context if available
    $user = $request->attributes->get('_user');
    if ($user && isset($user['id'])) {
      $context['user_id'] = $user['id'];
    }

    // Log at different levels based on response time
    if ($responseTime > $this->slowRequestThreshold) {
      $this->logger->warning('Slow request detected', $context);
    } elseif ($response->getStatusCode() >= 400) {
      $this->logger->info('Request completed with error', $context);
    } else {
      $this->logger->debug('Request completed', $context);
    }
  }
}
