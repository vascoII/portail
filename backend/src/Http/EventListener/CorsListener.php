<?php

declare(strict_types=1);

namespace App\Http\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * CORS listener that handles preflight requests and adds CORS headers.
 */
final class CorsListener implements EventSubscriberInterface
{
    public function __construct(
        private readonly array $allowedOrigins = ['*'],
        private readonly array $allowedMethods = ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
        private readonly array $allowedHeaders = ['Content-Type', 'Authorization', 'X-Request-ID'],
        private readonly bool $allowCredentials = false,
        private readonly int $maxAge = 3600
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 100],
            KernelEvents::RESPONSE => ['onKernelResponse', -100],
            KernelEvents::EXCEPTION => ['onKernelException', -100],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $request = $event->getRequest();

        if (! str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }

        $exception = $event->getThrowable();
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500;

        $response = new Response($exception->getMessage(), $statusCode);
        $this->addCorsHeaders($response, $request);
        $event->setResponse($response);
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        // Skip non-API requests
        if (! str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }

        // Handle preflight requests
        if ('OPTIONS' === $request->getMethod()) {
            $response = new Response();
            $this->addCorsHeaders($response, $request);
            $event->setResponse($response);
        }
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        // Skip non-API requests
        if (! str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }

        // Add CORS headers to all responses
        $this->addCorsHeaders($response, $request);
    }

    /**
     * Add CORS headers to response.
     */
    private function addCorsHeaders(Response $response, Request $request): void
    {
        $origin = $request->headers->get('Origin');

        // Check if origin is allowed
        if ($this->isOriginAllowed($origin)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
        } elseif (in_array('*', $this->allowedOrigins, true)) {
            $response->headers->set('Access-Control-Allow-Origin', '*');
        }

        // Add other CORS headers
        $response->headers->set('Access-Control-Allow-Methods', implode(', ', $this->allowedMethods));
        $response->headers->set('Access-Control-Allow-Headers', implode(', ', $this->allowedHeaders));
        $response->headers->set('Access-Control-Max-Age', (string) $this->maxAge);

        if ($this->allowCredentials) {
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
        }

        // Add exposed headers
        $response->headers->set('Access-Control-Expose-Headers', 'X-Request-ID');
    }

    /**
     * Check if origin is allowed.
     */
    private function isOriginAllowed(?string $origin): bool
    {
        if (! $origin) {
            return false;
        }

        return in_array($origin, $this->allowedOrigins, true);
    }
}
