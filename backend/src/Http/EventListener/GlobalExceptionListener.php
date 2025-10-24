<?php

declare(strict_types=1);

namespace App\Http\EventListener;

use App\Application\Exception\ApplicationException;
use App\Domain\Exception\DomainException;
use App\Http\Exception\AuthenticationException;
use App\Http\Exception\AuthorizationException;
use App\Http\Exception\BadRequestException;
use App\Http\Exception\HttpException;
use App\Http\Exception\HttpExceptionFactory;
use App\Http\Exception\InternalServerErrorException;
use App\Infrastructure\Exception\InfrastructureException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Global exception listener that handles all exceptions and converts them to appropriate HTTP responses.
 */
final class GlobalExceptionListener implements EventSubscriberInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SerializerInterface $serializer
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', -100],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $request = $event->getRequest();

        // Skip non-API requests
        if (! str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }

        // Convert exception to HTTP exception
        $httpException = $this->convertToHttpException($exception, $request);

        // Log the exception
        $this->logException($httpException, $request);

        // Create response
        $response = $this->createResponse($httpException, $request);

        // Set the response
        $event->setResponse($response);
    }

    /**
     * Build log context from exception and request.
     */
    private function buildLogContext(HttpException $httpException, Request $request): array
    {
        $context = [
            'exception_class' => get_class($httpException),
            'http_status_code' => $httpException->getStatusCode(),
            'http_status_text' => $httpException->getStatusText(),
            'error_code' => $httpException->getErrorCode(),
            'component' => $httpException->getComponent(),
            'operation' => $httpException->getOperation(),
            'request_method' => $request->getMethod(),
            'request_uri' => $request->getUri(),
            'request_route' => $request->attributes->get('_route', 'unknown'),
            'client_ip' => $request->getClientIp(),
            'user_agent' => $request->headers->get('User-Agent'),
        ];

        // Add exception context
        $exceptionContext = $httpException->getContext();
        if (! empty($exceptionContext)) {
            $context['exception_context'] = $exceptionContext;
        }

        // Add input data (sanitized)
        $inputData = $httpException->getInputData();
        if (! empty($inputData)) {
            $context['input_data'] = $inputData;
        }

        // Add previous exception if present
        $previous = $httpException->getPrevious();
        if ($previous) {
            $context['previous_exception'] = [
                'class' => get_class($previous),
                'message' => $previous->getMessage(),
                'file' => $previous->getFile(),
                'line' => $previous->getLine(),
            ];
        }

        // Add stack trace for 5xx errors
        if ($httpException->getStatusCode() >= 500) {
            $context['stack_trace'] = $httpException->getTraceAsString();
        }

        return $context;
    }

    /**
     * Convert Symfony HTTP exception to our HTTP exception.
     */
    private function convertSymfonyHttpException(HttpExceptionInterface $exception, Request $request): HttpException
    {
        $statusCode = $exception->getStatusCode();

        return match ($statusCode) {
            400 => new BadRequestException(
                $exception->getMessage(),
                'Symfony',
                'http_exception',
                ['symfony_exception' => get_class($exception)],
                [],
                [],
                $exception
            ),
            401 => new AuthenticationException(
                $exception->getMessage(),
                'Symfony',
                'http_exception',
                ['symfony_exception' => get_class($exception)],
                [],
                [],
                $exception
            ),
            403 => new AuthorizationException(
                $exception->getMessage(),
                'Symfony',
                'http_exception',
                ['symfony_exception' => get_class($exception)],
                [],
                [],
                $exception
            ),
            404 => new BadRequestException(
                'Resource not found',
                'Symfony',
                'http_exception',
                ['symfony_exception' => get_class($exception)],
                [],
                [],
                $exception
            ),
            405 => new BadRequestException(
                'Method not allowed',
                'Symfony',
                'http_exception',
                ['symfony_exception' => get_class($exception)],
                [],
                [],
                $exception
            ),
            422 => new BadRequestException(
                'Unprocessable entity',
                'Symfony',
                'http_exception',
                ['symfony_exception' => get_class($exception)],
                [],
                [],
                $exception
            ),
            default => new InternalServerErrorException(
                $exception->getMessage(),
                'Symfony',
                'http_exception',
                ['symfony_exception' => get_class($exception)],
                [],
                [],
                $exception
            ),
        };
    }

    /**
     * Convert any exception to an appropriate HTTP exception.
     */
    private function convertToHttpException(\Throwable $exception, Request $request): HttpException
    {
        // If it's already an HTTP exception, return it
        if ($exception instanceof HttpException) {
            return $exception;
        }

        // If it's a Symfony HTTP exception, convert it
        if ($exception instanceof HttpExceptionInterface) {
            return $this->convertSymfonyHttpException($exception, $request);
        }

        // Map exceptions from different layers
        return match (true) {
            $exception instanceof DomainException => HttpExceptionFactory::fromDomainException($exception),
            $exception instanceof ApplicationException => HttpExceptionFactory::fromApplicationException($exception),
            $exception instanceof InfrastructureException => HttpExceptionFactory::fromInfrastructureException($exception),
            default => HttpExceptionFactory::fromGenericException($exception),
        };
    }

    /**
     * Create HTTP response from exception.
     */
    private function createResponse(HttpException $httpException, Request $request): JsonResponse
    {
        // Get API response data
        $responseData = $httpException->toApiResponse();

        // Add request ID if available
        $requestId = $request->attributes->get('request_id');
        if ($requestId) {
            $responseData['request_id'] = $requestId;
        }

        // Create headers
        $headers = $httpException->getHeaders();

        // Add CORS headers if needed
        $headers['Access-Control-Allow-Origin'] = '*';
        $headers['Access-Control-Allow-Methods'] = 'GET, POST, PUT, DELETE, OPTIONS';
        $headers['Access-Control-Allow-Headers'] = 'Content-Type, Authorization, X-Request-ID';

        // Add request ID to response headers
        if ($requestId) {
            $headers['X-Request-ID'] = $requestId;
        }

        // Serialize response
        $jsonContent = $this->serializer->serialize($responseData, 'json');

        return new JsonResponse(
            $jsonContent,
            $httpException->getStatusCode(),
            $headers,
            true // Already JSON
        );
    }

    /**
     * Log the exception.
     */
    private function logException(HttpException $httpException, Request $request): void
    {
        $logLevel = $httpException->getLogLevel();
        $context = $this->buildLogContext($httpException, $request);

        $this->logger->log($logLevel, $httpException->getMessage(), $context);
    }
}
