<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Application\Exception\ApplicationException;

/**
 * Exception for internal server errors
 * 
 * This exception represents server-side errors and maps to HTTP 500.
 */
final class InternalServerErrorException extends HttpException
{
  public function __construct(
    string $message = 'Internal server error',
    string $component = 'Server',
    string $operation = 'process_request',
    array $context = [],
    array $inputData = [],
    array $headers = [],
    ?\Throwable $previous = null
  ) {
    parent::__construct(
      $message,
      500,
      'Internal Server Error',
      $component,
      $operation,
      'INTERNAL_SERVER_ERROR',
      $context,
      $inputData,
      [],
      $headers,
      $previous
    );
  }

  /**
   * Create for application exception
   */
  public static function fromApplicationException(
    ApplicationException $applicationException
  ): self {
    return new self(
      $applicationException->getMessage(),
      $applicationException->getComponent(),
      $applicationException->getOperation(),
      $applicationException->getContext(),
      $applicationException->getInputData(),
      [],
      $applicationException
    );
  }

  /**
   * Create for unexpected error
   */
  public static function unexpectedError(
    string $component,
    string $operation,
    ?\Throwable $previous = null
  ): self {
    return new self(
      'An unexpected error occurred',
      $component,
      $operation,
      [
        'reason' => 'unexpected_error',
        'error_type' => $previous ? get_class($previous) : 'Unknown',
      ],
      [],
      [],
      $previous
    );
  }

  /**
   * Create for service unavailable
   */
  public static function serviceUnavailable(
    string $service,
    string $reason = '',
    ?\Exception $previous = null
  ): self {
    $message = "Service '{$service}' is unavailable";
    if ($reason) {
      $message .= ": {$reason}";
    }

    return new self(
      $message,
      'Service',
      'check_availability',
      [
        'reason' => 'service_unavailable',
        'service' => $service,
        'details' => $reason,
      ],
      [],
      [],
      $previous
    );
  }

  /**
   * Create for database error
   */
  public static function databaseError(
    string $operation,
    string $reason = '',
    ?\Exception $previous = null
  ): self {
    $message = "Database error during '{$operation}'";
    if ($reason) {
      $message .= ": {$reason}";
    }

    return new self(
      $message,
      'Database',
      $operation,
      [
        'reason' => 'database_error',
        'operation' => $operation,
        'details' => $reason,
      ],
      [],
      [],
      $previous
    );
  }

  /**
   * Create for external service error
   */
  public static function externalServiceError(
    string $service,
    string $operation,
    string $reason = '',
    ?\Exception $previous = null
  ): self {
    $message = "External service '{$service}' error during '{$operation}'";
    if ($reason) {
      $message .= ": {$reason}";
    }

    return new self(
      $message,
      'ExternalService',
      $operation,
      [
        'reason' => 'external_service_error',
        'service' => $service,
        'operation' => $operation,
        'details' => $reason,
      ],
      [],
      [],
      $previous
    );
  }

  /**
   * Create for configuration error
   */
  public static function configurationError(
    string $configKey,
    string $reason = '',
    ?\Exception $previous = null
  ): self {
    $message = "Configuration error for '{$configKey}'";
    if ($reason) {
      $message .= ": {$reason}";
    }

    return new self(
      $message,
      'Configuration',
      'load_config',
      [
        'reason' => 'configuration_error',
        'config_key' => $configKey,
        'details' => $reason,
      ],
      [],
      [],
      $previous
    );
  }

  /**
   * Create for memory error
   */
  public static function memoryError(
    int $memoryLimit,
    int $currentUsage
  ): self {
    return new self(
      'Memory limit exceeded',
      'Server',
      'memory_management',
      [
        'reason' => 'memory_error',
        'memory_limit' => $memoryLimit,
        'current_usage' => $currentUsage,
      ]
    );
  }

  /**
   * Create for timeout error
   */
  public static function timeoutError(
    string $operation,
    int $timeoutSeconds
  ): self {
    return new self(
      "Operation '{$operation}' timed out after {$timeoutSeconds} seconds",
      'Server',
      $operation,
      [
        'reason' => 'timeout_error',
        'operation' => $operation,
        'timeout_seconds' => $timeoutSeconds,
      ]
    );
  }

  /**
   * Create for file system error
   */
  public static function fileSystemError(
    string $operation,
    string $path,
    string $reason = '',
    ?\Exception $previous = null
  ): self {
    $message = "File system error during '{$operation}' on '{$path}'";
    if ($reason) {
      $message .= ": {$reason}";
    }

    return new self(
      $message,
      'FileSystem',
      $operation,
      [
        'reason' => 'filesystem_error',
        'operation' => $operation,
        'path' => $path,
        'details' => $reason,
      ],
      [],
      [],
      $previous
    );
  }

  /**
   * Get user-friendly error message
   */
  public function getApiMessage(): string
  {
    // In production, always return generic message for 500 errors
    if (!$this->isDevelopment()) {
      return 'An internal server error occurred';
    }

    // In development, provide more details
    return match ($this->context['reason'] ?? '') {
      'unexpected_error' => 'An unexpected error occurred',
      'service_unavailable' => 'A required service is temporarily unavailable',
      'database_error' => 'Database operation failed',
      'external_service_error' => 'External service error',
      'configuration_error' => 'Configuration error',
      'memory_error' => 'Memory limit exceeded',
      'timeout_error' => 'Operation timed out',
      'filesystem_error' => 'File system error',
      default => 'Internal server error',
    };
  }

  /**
   * Check if we're in development mode
   */
  private function isDevelopment(): bool
  {
    return ($_ENV['APP_ENV'] ?? 'prod') === 'dev';
  }
}
