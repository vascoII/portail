<?php

declare(strict_types=1);

namespace App\Http\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Listener that adds a unique request ID to each request for tracking purposes
 */
final class RequestIdListener implements EventSubscriberInterface
{
  public static function getSubscribedEvents(): array
  {
    return [
      KernelEvents::REQUEST => ['onKernelRequest', 1000],
      KernelEvents::RESPONSE => ['onKernelResponse', -1000],
    ];
  }

  public function onKernelRequest(RequestEvent $event): void
  {
    $request = $event->getRequest();

    // Skip non-API requests
    if (!str_starts_with($request->getPathInfo(), '/api/')) {
      return;
    }

    // Get request ID from header or generate one
    $requestId = $request->headers->get('X-Request-ID') ?: $this->generateRequestId();

    // Store in request attributes for use throughout the request lifecycle
    $request->attributes->set('request_id', $requestId);
  }

  public function onKernelResponse(ResponseEvent $event): void
  {
    $request = $event->getRequest();
    $response = $event->getResponse();

    // Skip non-API requests
    if (!str_starts_with($request->getPathInfo(), '/api/')) {
      return;
    }

    // Get request ID from request attributes
    $requestId = $request->attributes->get('request_id');

    if ($requestId) {
      // Add request ID to response headers
      $response->headers->set('X-Request-ID', $requestId);
    }
  }

  /**
   * Generate a unique request ID
   */
  private function generateRequestId(): string
  {
    return sprintf(
      '%s-%s-%s',
      date('Ymd'),
      substr(uniqid(), -8),
      substr(bin2hex(random_bytes(4)), 0, 8)
    );
  }
}
