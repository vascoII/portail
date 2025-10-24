<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

use App\Domain\Exception\DomainException;

/**
 * Base exception for all infrastructure-related errors.
 *
 * This exception represents technical failures in external services,
 * data persistence, or other infrastructure concerns.
 */
abstract class InfrastructureException extends DomainException
{
    /**
     * The operation that was being performed.
     */
    protected string $operation = '';

    /**
     * The service or component that failed.
     */
    protected string $service = '';

    /**
     * Additional technical details.
     */
    protected array $technicalDetails = [];

    public function __construct(
        string $message,
        string $service,
        string $operation = '',
        string $errorCode = '',
        array $context = [],
        array $technicalDetails = [],
        ?\Exception $previous = null
    ) {
        // Add infrastructure-specific context
        $context['service'] = $service;
        if ($operation) {
            $context['operation'] = $operation;
        }
        $context['technical_details'] = $technicalDetails;

        parent::__construct($message, $errorCode, $context, $previous);

        $this->service = $service;
        $this->operation = $operation;
        $this->technicalDetails = $technicalDetails;
    }

    /**
     * Add technical detail.
     */
    public function addTechnicalDetail(string $key, mixed $value): self
    {
        $this->technicalDetails[$key] = $value;
        $this->context['technical_details'] = $this->technicalDetails;

        return $this;
    }

    /**
     * Get maximum retry attempts.
     */
    public function getMaxRetries(): int
    {
        return 0; // Override in subclasses
    }

    /**
     * Get the operation that was being performed.
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * Get suggested retry delay in seconds.
     */
    public function getRetryDelay(): int
    {
        return 0; // Override in subclasses
    }

    /**
     * Get the service that failed.
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * Get technical detail by key.
     */
    public function getTechnicalDetail(string $key, mixed $default = null): mixed
    {
        return $this->technicalDetails[$key] ?? $default;
    }

    /**
     * Get technical details.
     */
    public function getTechnicalDetails(): array
    {
        return $this->technicalDetails;
    }

    /**
     * Check if this is a retryable error.
     */
    public function isRetryable(): bool
    {
        return false; // Override in subclasses
    }
}
