<?php

declare(strict_types=1);

namespace App\Application\Exception;

use App\Infrastructure\Exception\InfrastructureException;

/**
 * Exception for Application service failures
 * 
 * This exception represents failures in application services,
 * such as service initialization, configuration errors, or
 * service-specific business logic violations.
 */
final class ServiceException extends ApplicationException
{
  /**
   * The service class that failed
   */
  private string $serviceClass = '';

  /**
   * The service method that failed
   */
  private string $serviceMethod = '';

  /**
   * Service configuration that caused the failure
   */
  private array $serviceConfig = [];

  public function __construct(
    string $message,
    string $serviceClass,
    string $serviceMethod = '',
    string $operation = '',
    array $context = [],
    array $inputData = [],
    array $outputData = [],
    array $serviceConfig = [],
    ?\Exception $previous = null
  ) {
    $errorCode = 'SERVICE_EXECUTION_FAILED';

    // Add service-specific context
    $context['service_class'] = $serviceClass;
    if ($serviceMethod) {
      $context['service_method'] = $serviceMethod;
    }
    $context['service_config'] = $this->sanitizeConfig($serviceConfig);

    parent::__construct(
      $message,
      $serviceClass,
      $operation,
      $errorCode,
      $context,
      $inputData,
      $outputData,
      $previous
    );

    $this->serviceClass = $serviceClass;
    $this->serviceMethod = $serviceMethod;
    $this->serviceConfig = $this->sanitizeConfig($serviceConfig);
  }

  /**
   * Get the service class that failed
   */
  public function getServiceClass(): string
  {
    return $this->serviceClass;
  }

  /**
   * Get the service method that failed
   */
  public function getServiceMethod(): string
  {
    return $this->serviceMethod;
  }

  /**
   * Get sanitized service configuration
   */
  public function getServiceConfig(): array
  {
    return $this->serviceConfig;
  }

  /**
   * Sanitize service configuration by removing sensitive data
   */
  private function sanitizeConfig(array $config): array
  {
    $sensitiveKeys = [
      'password',
      'token',
      'jwt',
      'secret',
      'key',
      'api_key',
      'sessionId',
      'pkUser',
      'SessionID',
      'PkUser'
    ];

    return $this->recursiveSanitize($config, $sensitiveKeys);
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
    return true; // Service exceptions are generally technical failures
  }

  /**
   * Get the appropriate log level for this exception
   */
  public function getLogLevel(): string
  {
    return 'error';
  }

  /**
   * Create from Infrastructure exception
   */
  public static function fromInfrastructureException(
    InfrastructureException $infrastructureException,
    string $serviceClass,
    string $serviceMethod = '',
    array $inputData = []
  ): self {
    return new self(
      $infrastructureException->getMessage(),
      $serviceClass,
      $serviceMethod,
      'infrastructure_integration',
      $infrastructureException->getContext(),
      $inputData,
      [],
      [],
      $infrastructureException
    );
  }

  /**
   * Create for service initialization failure
   */
  public static function initializationFailed(
    string $serviceClass,
    string $reason,
    array $serviceConfig = [],
    ?\Exception $previous = null
  ): self {
    return new self(
      "Service initialization failed: {$reason}",
      $serviceClass,
      '__construct',
      'initialization',
      ['reason' => $reason],
      [],
      [],
      $serviceConfig,
      $previous
    );
  }

  /**
   * Create for service configuration error
   */
  public static function configurationError(
    string $serviceClass,
    string $configKey,
    string $expectedType,
    mixed $actualValue,
    array $serviceConfig = []
  ): self {
    return new self(
      "Service configuration error for '{$configKey}'. Expected: {$expectedType}, Got: " . gettype($actualValue),
      $serviceClass,
      'configuration',
      'configuration',
      [
        'config_key' => $configKey,
        'expected_type' => $expectedType,
        'actual_type' => gettype($actualValue),
      ],
      [],
      [],
      $serviceConfig
    );
  }

  /**
   * Create for service method failure
   */
  public static function methodFailed(
    string $serviceClass,
    string $serviceMethod,
    string $reason,
    array $inputData = [],
    ?\Exception $previous = null
  ): self {
    return new self(
      "Service method '{$serviceMethod}' failed: {$reason}",
      $serviceClass,
      $serviceMethod,
      'method_execution',
      ['reason' => $reason],
      $inputData,
      [],
      [],
      $previous
    );
  }

  /**
   * Create for service dependency failure
   */
  public static function dependencyFailed(
    string $serviceClass,
    string $dependencyClass,
    string $reason,
    array $inputData = [],
    ?\Exception $previous = null
  ): self {
    return new self(
      "Service dependency '{$dependencyClass}' failed: {$reason}",
      $serviceClass,
      'dependency',
      'dependency_injection',
      [
        'dependency_class' => $dependencyClass,
        'reason' => $reason,
      ],
      $inputData,
      [],
      [],
      $previous
    );
  }

  /**
   * Create for service business logic violation
   */
  public static function businessLogicViolation(
    string $serviceClass,
    string $serviceMethod,
    string $rule,
    string $message,
    array $inputData = [],
    array $context = []
  ): self {
    return new self(
      "Service business logic violation: {$message}",
      $serviceClass,
      $serviceMethod,
      'business_logic',
      array_merge($context, ['rule' => $rule]),
      $inputData,
      []
    );
  }
}
