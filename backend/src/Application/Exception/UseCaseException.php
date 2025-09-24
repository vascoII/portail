<?php

declare(strict_types=1);

namespace App\Application\Exception;

use App\Domain\Exception\DomainException;
use App\Infrastructure\Exception\InfrastructureException;

/**
 * Exception for UseCase execution failures
 * 
 * This exception represents failures during UseCase execution,
 * such as business logic violations, service failures, or
 * data transformation errors.
 */
final class UseCaseException extends ApplicationException
{
  /**
   * The UseCase class that failed
   */
  private string $useCaseClass = '';

  /**
   * The input DTO that was being processed
   */
  private ?string $inputDtoClass = null;

  /**
   * The output DTO that was being generated
   */
  private ?string $outputDtoClass = null;

  public function __construct(
    string $message,
    string $useCaseClass,
    ?string $inputDtoClass = null,
    ?string $outputDtoClass = null,
    string $operation = '',
    array $context = [],
    array $inputData = [],
    array $outputData = [],
    ?\Exception $previous = null
  ) {
    $errorCode = 'USE_CASE_EXECUTION_FAILED';

    // Add UseCase-specific context
    $context['use_case_class'] = $useCaseClass;
    if ($inputDtoClass) {
      $context['input_dto_class'] = $inputDtoClass;
    }
    if ($outputDtoClass) {
      $context['output_dto_class'] = $outputDtoClass;
    }

    parent::__construct(
      $message,
      $useCaseClass,
      $operation,
      $errorCode,
      $context,
      $inputData,
      $outputData,
      $previous
    );

    $this->useCaseClass = $useCaseClass;
    $this->inputDtoClass = $inputDtoClass;
    $this->outputDtoClass = $outputDtoClass;
  }

  /**
   * Get the UseCase class that failed
   */
  public function getUseCaseClass(): string
  {
    return $this->useCaseClass;
  }

  /**
   * Get the input DTO class
   */
  public function getInputDtoClass(): ?string
  {
    return $this->inputDtoClass;
  }

  /**
   * Get the output DTO class
   */
  public function getOutputDtoClass(): string
  {
    return $this->outputDtoClass;
  }

  /**
   * Check if this exception should be logged as an error
   */
  public function shouldLogAsError(): bool
  {
    // UseCase exceptions are generally business logic failures
    return false;
  }

  /**
   * Get the appropriate log level for this exception
   */
  public function getLogLevel(): string
  {
    return 'warning';
  }

  /**
   * Create from Domain exception
   */
  public static function fromDomainException(
    DomainException $domainException,
    string $useCaseClass,
    ?string $inputDtoClass = null,
    ?string $outputDtoClass = null,
    array $inputData = []
  ): self {
    return new self(
      $domainException->getMessage(),
      $useCaseClass,
      $inputDtoClass,
      $outputDtoClass,
      'domain_validation',
      $domainException->getContext(),
      $inputData,
      [],
      $domainException
    );
  }

  /**
   * Create from Infrastructure exception
   */
  public static function fromInfrastructureException(
    InfrastructureException $infrastructureException,
    string $useCaseClass,
    ?string $inputDtoClass = null,
    ?string $outputDtoClass = null,
    array $inputData = []
  ): self {
    return new self(
      $infrastructureException->getMessage(),
      $useCaseClass,
      $inputDtoClass,
      $outputDtoClass,
      'infrastructure_service',
      $infrastructureException->getContext(),
      $inputData,
      [],
      $infrastructureException
    );
  }

  /**
   * Create for UseCase execution failure
   */
  public static function executionFailed(
    string $useCaseClass,
    string $operation,
    string $reason,
    ?string $inputDtoClass = null,
    ?string $outputDtoClass = null,
    array $inputData = [],
    ?\Exception $previous = null
  ): self {
    return new self(
      "UseCase execution failed during '{$operation}': {$reason}",
      $useCaseClass,
      $inputDtoClass,
      $outputDtoClass,
      $operation,
      ['reason' => $reason],
      $inputData,
      [],
      $previous
    );
  }

  /**
   * Create for data transformation failure
   */
  public static function transformationFailed(
    string $useCaseClass,
    string $sourceType,
    string $targetType,
    string $reason,
    ?string $inputDtoClass = null,
    ?string $outputDtoClass = null,
    array $inputData = [],
    ?\Exception $previous = null
  ): self {
    return new self(
      "Data transformation failed from '{$sourceType}' to '{$targetType}': {$reason}",
      $useCaseClass,
      $inputDtoClass,
      $outputDtoClass,
      'transformation',
      [
        'source_type' => $sourceType,
        'target_type' => $targetType,
        'reason' => $reason,
      ],
      $inputData,
      [],
      $previous
    );
  }

  /**
   * Create for service orchestration failure
   */
  public static function serviceOrchestrationFailed(
    string $useCaseClass,
    string $serviceName,
    string $operation,
    string $reason,
    ?string $inputDtoClass = null,
    ?string $outputDtoClass = null,
    array $inputData = [],
    ?\Exception $previous = null
  ): self {
    return new self(
      "Service orchestration failed for '{$serviceName}' during '{$operation}': {$reason}",
      $useCaseClass,
      $inputDtoClass,
      $outputDtoClass,
      'service_orchestration',
      [
        'service_name' => $serviceName,
        'operation' => $operation,
        'reason' => $reason,
      ],
      $inputData,
      [],
      $previous
    );
  }

  /**
   * Create for business logic violation
   */
  public static function businessLogicViolation(
    string $useCaseClass,
    string $rule,
    string $message,
    ?string $inputDtoClass = null,
    ?string $outputDtoClass = null,
    array $inputData = [],
    array $context = []
  ): self {
    return new self(
      "Business logic violation in UseCase: {$message}",
      $useCaseClass,
      $inputDtoClass,
      $outputDtoClass,
      'business_logic',
      array_merge($context, ['rule' => $rule]),
      $inputData,
      []
    );
  }
}
