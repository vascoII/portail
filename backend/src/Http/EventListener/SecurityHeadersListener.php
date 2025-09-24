<?php

declare(strict_types=1);

namespace App\Http\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Listener that adds security headers to all API responses
 */
final class SecurityHeadersListener implements EventSubscriberInterface
{
  public function __construct(
    private readonly bool $enableSecurityHeaders = true,
    private readonly string $contentSecurityPolicy = "default-src 'self'",
    private readonly bool $enableHsts = true,
    private readonly int $hstsMaxAge = 31536000, // 1 year
    private readonly bool $enableFrameOptions = true,
    private readonly string $frameOptions = 'DENY',
    private readonly bool $enableContentTypeOptions = true,
    private readonly bool $enableReferrerPolicy = true,
    private readonly string $referrerPolicy = 'strict-origin-when-cross-origin'
  ) {}

  public static function getSubscribedEvents(): array
  {
    return [
      KernelEvents::RESPONSE => ['onKernelResponse', -1000],
    ];
  }

  public function onKernelResponse(ResponseEvent $event): void
  {
    $request = $event->getRequest();
    $response = $event->getResponse();

    // Skip non-API requests
    if (!str_starts_with($request->getPathInfo(), '/api/')) {
      return;
    }

    // Skip if security headers are disabled
    if (!$this->enableSecurityHeaders) {
      return;
    }

    $this->addSecurityHeaders($response, $request);
  }

  /**
   * Add security headers to response
   */
  private function addSecurityHeaders(Response $response, Request $request): void
  {
    // Content Security Policy
    if ($this->contentSecurityPolicy) {
      $response->headers->set('Content-Security-Policy', $this->contentSecurityPolicy);
    }

    // HTTP Strict Transport Security (only for HTTPS)
    if ($this->enableHsts && $request->isSecure()) {
      $hstsHeader = "max-age={$this->hstsMaxAge}";
      if ($this->hstsMaxAge > 0) {
        $hstsHeader .= '; includeSubDomains';
      }
      $response->headers->set('Strict-Transport-Security', $hstsHeader);
    }

    // X-Frame-Options
    if ($this->enableFrameOptions) {
      $response->headers->set('X-Frame-Options', $this->frameOptions);
    }

    // X-Content-Type-Options
    if ($this->enableContentTypeOptions) {
      $response->headers->set('X-Content-Type-Options', 'nosniff');
    }

    // Referrer Policy
    if ($this->enableReferrerPolicy) {
      $response->headers->set('Referrer-Policy', $this->referrerPolicy);
    }

    // X-XSS-Protection (legacy but still useful for older browsers)
    $response->headers->set('X-XSS-Protection', '1; mode=block');

    // Permissions Policy (formerly Feature Policy)
    $permissionsPolicy = implode(', ', [
      'camera=()',
      'microphone=()',
      'geolocation=()',
      'payment=()',
      'usb=()',
      'magnetometer=()',
      'gyroscope=()',
      'accelerometer=()',
    ]);
    $response->headers->set('Permissions-Policy', $permissionsPolicy);

    // Cache-Control for API responses
    $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
    $response->headers->set('Pragma', 'no-cache');
    $response->headers->set('Expires', '0');
  }
}
