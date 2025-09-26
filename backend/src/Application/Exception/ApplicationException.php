<?php

declare(strict_types=1);

namespace App\Application\Exception;

use App\Domain\Exception\DomainException;

/**
 * Base exception for all application-related errors
 * 
 * This exception represents failures in the application layer,
 * such as UseCase execution failures, service orchestration errors,
 * or application-specific business logic violations.
 */
abstract class ApplicationException extends DomainException
{
  /**
   * The UseCase or service that failed
   */
  protected string $component = '';

  /**
   * The operation that was being performed
   */
  protected string $operation = '';

  /**
   * Input data that caused the failure (sanitized)
   */
  protected array $inputData = [];

  /**
   * Output data that was being generated (sanitized)
   */
  protected array $outputData = [];

  public function __construct(
    string $message,
    string $component,
    string $operation = '',
    string $errorCode = '',
    array $context = [],
    array $inputData = [],
    array $outputData = [],
    ?\Throwable $previous = null
  ) {
    // Add application-specific context
    $context['component'] = $component;
    if ($operation) {
      $context['operation'] = $operation;
    }
    $context['input_data'] = $this->sanitizeData($inputData);
    $context['output_data'] = $this->sanitizeData($outputData);

    parent::__construct($message, $errorCode, $context, $previous);

    $this->component = $component;
    $this->operation = $operation;
    $this->inputData = $this->sanitizeData($inputData);
    $this->outputData = $this->sanitizeData($outputData);
  }

  /**
   * Get the component that failed
   */
  public function getComponent(): string
  {
    return $this->component;
  }

  /**
   * Get the operation that was being performed
   */
  public function getOperation(): string
  {
    return $this->operation;
  }

  /**
   * Get sanitized input data
   */
  public function getInputData(): array
  {
    return $this->inputData;
  }

  /**
   * Get sanitized output data
   */
  public function getOutputData(): array
  {
    return $this->outputData;
  }

  /**
   * Sanitize data by removing sensitive information
   */
  private function sanitizeData(array $data): array
  {
    $sensitiveKeys = [
      'password',
      'token',
      'jwt',
      'sessionId',
      'pkUser',
      'SessionID',
      'PkUser',
      'authorization',
      'cookie'
    ];

    return $this->recursiveSanitize($data, $sensitiveKeys);
  }

  /**
   * Recursively sanitize array data
   */
  private function recursiveSanitize(array $data, array $sensitiveKeys): array
  {
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $data[$key] = $this->recursiveSanitize($value, $sensitiveKeys);
      } elseif (in_array($key, $sensitiveKeys, true)) {
        $data[$key] = '[REDACTED]';
      }
    }

    return $data;
  }

  /**
   * Check if this exception should be logged as an error
   */
  public function shouldLogAsError(): bool
  {
    return true; // Override in subclasses
  }

  /**
   * Get the appropriate log level for this exception
   */
  public function getLogLevel(): string
  {
    return 'error'; // Override in subclasses
  }

  /**
   * Get user-friendly error message for API responses
   */
  public function getApiMessage(): string
  {
    return $this->getUserMessage() ?: 'An application error occurred';
  }
}
