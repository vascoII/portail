<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Application\Exception\ApplicationException;

/**
 * Base exception for all HTTP-related errors
 * 
 * This exception represents HTTP-specific failures and provides
 * mapping to HTTP status codes and user-friendly error messages.
 */
abstract class HttpException extends ApplicationException
{
  /**
   * HTTP status code
   */
  protected int $statusCode;

  /**
   * HTTP status text
   */
  protected string $statusText;

  /**
   * Additional HTTP headers
   */
  protected array $headers = [];

  public function __construct(
    string $message,
    int $statusCode,
    string $statusText = '',
    string $component = 'HTTP',
    string $operation = '',
    string $errorCode = '',
    array $context = [],
    array $inputData = [],
    array $outputData = [],
    array $headers = [],
    ?\Throwable $previous = null
  ) {
    // Add HTTP-specific context
    $context['http_status_code'] = $statusCode;
    $context['http_status_text'] = $statusText;
    $context['http_headers'] = $headers;

    parent::__construct(
      $message,
      $component,
      $operation,
      $errorCode,
      $context,
      $inputData,
      $outputData,
      $previous
    );

    $this->statusCode = $statusCode;
    $this->statusText = $statusText ?: $this->getDefaultStatusText($statusCode);
    $this->headers = $headers;
  }

  /**
   * Get HTTP status code
   */
  public function getStatusCode(): int
  {
    return $this->statusCode;
  }

  /**
   * Get HTTP status text
   */
  public function getStatusText(): string
  {
    return $this->statusText;
  }

  /**
   * Get HTTP headers
   */
  public function getHeaders(): array
  {
    return $this->headers;
  }

  /**
   * Add HTTP header
   */
  public function addHeader(string $name, string $value): self
  {
    $this->headers[$name] = $value;
    $this->context['http_headers'] = $this->headers;
    return $this;
  }

  /**
   * Get default status text for status code
   */
  private function getDefaultStatusText(int $statusCode): string
  {
    return match ($statusCode) {
      400 => 'Bad Request',
      401 => 'Unauthorized',
      403 => 'Forbidden',
      404 => 'Not Found',
      405 => 'Method Not Allowed',
      422 => 'Unprocessable Entity',
      429 => 'Too Many Requests',
      500 => 'Internal Server Error',
      502 => 'Bad Gateway',
      503 => 'Service Unavailable',
      504 => 'Gateway Timeout',
      default => 'Unknown',
    };
  }

  /**
   * Check if this exception should be logged as an error
   */
  public function shouldLogAsError(): bool
  {
    return $this->statusCode >= 500;
  }

  /**
   * Get the appropriate log level for this exception
   */
  public function getLogLevel(): string
  {
    return match (true) {
      $this->statusCode >= 500 => 'error',
      $this->statusCode >= 400 => 'warning',
      default => 'info',
    };
  }

  /**
   * Get user-friendly error message for API responses
   */
  public function getApiMessage(): string
  {
    // Use user message if set, otherwise use technical message
    $message = $this->getUserMessage() ?: $this->getMessage();

    // In production, don't expose technical details
    if ($this->statusCode >= 500 && !$this->isDevelopment()) {
      return 'An internal server error occurred';
    }

    return $message;
  }

  /**
   * Check if we're in development mode
   */
  private function isDevelopment(): bool
  {
    return ($_ENV['APP_ENV'] ?? 'prod') === 'dev';
  }

  /**
   * Convert to array for API response
   */
  public function toApiResponse(): array
  {
    $response = [
      'success' => false,
      'error' => [
        'code' => $this->getErrorCode() ?: 'HTTP_ERROR',
        'message' => $this->getApiMessage(),
        'status_code' => $this->statusCode,
      ],
    ];

    // Add details in development mode
    if ($this->isDevelopment()) {
      $response['error']['details'] = [
        'component' => $this->getComponent(),
        'operation' => $this->getOperation(),
        'context' => $this->getContext(),
      ];

      if ($this->getPrevious()) {
        $response['error']['details']['previous'] = [
          'class' => get_class($this->getPrevious()),
          'message' => $this->getPrevious()->getMessage(),
        ];
      }
    }

    return $response;
  }
}
