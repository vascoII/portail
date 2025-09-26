<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Exception;

/**
 * Base exception for all domain-related errors
 * 
 * This is the foundation for all business logic exceptions.
 * It provides context properties that can be used for logging and debugging.
 */
abstract class DomainException extends Exception
{
  /**
   * Additional context data for debugging and logging
   */
  protected array $context = [];

  /**
   * Error code for programmatic handling
   */
  protected string $errorCode = '';

  /**
   * User-friendly error message (can be different from technical message)
   */
  protected string $userMessage = '';

  public function __construct(
    string $message,
    string $errorCode = '',
    array $context = [],
    ?\Throwable $previous = null
  ) {
    parent::__construct($message, 0, $previous);

    $this->errorCode = $errorCode;
    $this->context = $context;
    $this->userMessage = $message; // Default to technical message
  }

  /**
   * Get the error code for programmatic handling
   */
  public function getErrorCode(): string
  {
    return $this->errorCode;
  }

  /**
   * Get additional context data
   */
  public function getContext(): array
  {
    return $this->context;
  }

  /**
   * Get user-friendly error message
   */
  public function getUserMessage(): string
  {
    return $this->userMessage;
  }

  /**
   * Set user-friendly error message
   */
  public function setUserMessage(string $userMessage): self
  {
    $this->userMessage = $userMessage;
    return $this;
  }

  /**
   * Add context data
   */
  public function addContext(string $key, mixed $value): self
  {
    $this->context[$key] = $value;
    return $this;
  }

  /**
   * Get context value by key
   */
  public function getContextValue(string $key, mixed $default = null): mixed
  {
    return $this->context[$key] ?? $default;
  }

  /**
   * Convert exception to array for logging/serialization
   */
  public function toArray(): array
  {
    return [
      'class' => static::class,
      'message' => $this->getMessage(),
      'error_code' => $this->errorCode,
      'user_message' => $this->userMessage,
      'context' => $this->context,
      'file' => $this->getFile(),
      'line' => $this->getLine(),
      'previous' => $this->getPrevious() ? [
        'class' => get_class($this->getPrevious()),
        'message' => $this->getPrevious()->getMessage(),
      ] : null,
    ];
  }
}
