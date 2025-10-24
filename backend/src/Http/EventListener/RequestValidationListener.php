<?php

declare(strict_types=1);

namespace App\Http\EventListener;

use App\Http\Exception\BadRequestException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Request validation listener that performs basic request validation.
 */
final class RequestValidationListener implements EventSubscriberInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly int $maxRequestSize = 10485760, // 10MB
        private readonly array $allowedContentTypes = ['application/json', 'application/x-www-form-urlencoded'],
        private readonly bool $enableValidation = true
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', -10],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        // Skip non-API requests
        if (! str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }

        // Skip if validation is disabled
        if (! $this->enableValidation) {
            return;
        }

        // Skip OPTIONS requests (CORS preflight)
        if ('OPTIONS' === $request->getMethod()) {
            return;
        }

        $this->validateRequest($event, $request);
    }

    /**
     * Create error response.
     */
    private function createErrorResponse(BadRequestException $exception): Response
    {
        return new Response(
            json_encode($exception->toApiResponse(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            $exception->getStatusCode(),
            array_merge(
                ['Content-Type' => 'application/json'],
                $exception->getHeaders()
            )
        );
    }

    /**
     * Log validation error.
     */
    private function logValidationError(string $message, Request $request, array $context = []): void
    {
        $this->logger->warning($message, array_merge([
            'request_method' => $request->getMethod(),
            'request_uri' => $request->getUri(),
            'client_ip' => $request->getClientIp(),
            'user_agent' => $request->headers->get('User-Agent'),
        ], $context));
    }

    /**
     * Validate JSON content.
     */
    private function validateJsonContent(RequestEvent $event, Request $request): void
    {
        $content = $request->getContent();

        if (empty($content)) {
            return;
        }

        $decoded = json_decode($content, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            $this->logValidationError('Malformed JSON', $request, [
                'json_error' => json_last_error_msg(),
                'content_preview' => substr($content, 0, 100),
            ]);

            $exception = BadRequestException::malformedJson(json_last_error_msg());
            $event->setResponse($this->createErrorResponse($exception));
        }
    }

    /**
     * Validate the incoming request.
     */
    private function validateRequest(RequestEvent $event, Request $request): void
    {
        // Check request size
        $contentLength = (int) $request->headers->get('Content-Length', '0');
        if ($contentLength > $this->maxRequestSize) {
            $this->logValidationError('Request too large', $request, [
                'content_length' => $contentLength,
                'max_size' => $this->maxRequestSize,
            ]);

            $exception = BadRequestException::requestTooLarge($contentLength, $this->maxRequestSize);
            $event->setResponse($this->createErrorResponse($exception));

            return;
        }

        // Check content type for POST/PUT requests
        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true)) {
            $contentType = $request->headers->get('Content-Type', '');
            $contentType = explode(';', $contentType)[0]; // Remove charset parameter

            if (! in_array($contentType, $this->allowedContentTypes, true)) {
                $this->logValidationError('Unsupported content type', $request, [
                    'content_type' => $contentType,
                    'allowed_types' => $this->allowedContentTypes,
                ]);

                $exception = BadRequestException::unsupportedContentType($contentType);
                $event->setResponse($this->createErrorResponse($exception));

                return;
            }
        }

        // Validate JSON for JSON requests
        $contentType = $request->headers->get('Content-Type', '');
        if (str_starts_with($contentType, 'application/json') && $request->getContent()) {
            $this->validateJsonContent($event, $request);
        }
    }
}
