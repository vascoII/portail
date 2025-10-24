<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Exception;

/**
 * Exception thrown when input validation fails.
 *
 * This exception represents validation failures for input data,
 * such as DTOs, request parameters, or business object creation.
 */
final class ValidationException extends DomainException
{
    /**
     * Validation errors organized by field.
     */
    private array $errors = [];

    /**
     * The object or data that failed validation.
     */
    private ?string $validatedObject = null;

    public function __construct(
        string $message,
        array $errors = [],
        ?string $validatedObject = null,
        array $context = [],
        ?\Exception $previous = null
    ) {
        $errorCode = 'VALIDATION_FAILED';

        // Add validation-specific context
        $context['errors'] = $errors;
        if ($validatedObject) {
            $context['validated_object'] = $validatedObject;
        }

        parent::__construct($message, $errorCode, $context, $previous);

        $this->errors = $errors;
        $this->validatedObject = $validatedObject;
    }

    /**
     * Add a validation error for a field.
     */
    public function addError(string $field, string $message, string $code = ''): self
    {
        if (! isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }

        $this->errors[$field][] = [
            'message' => $message,
            'code' => $code,
        ];

        return $this;
    }

    /**
     * Create a validation exception for a single field.
     */
    public static function fieldValidation(
        string $field,
        string $message,
        string $code = '',
        ?string $validatedObject = null
    ): self {
        $errors = [$field => [['message' => $message, 'code' => $code]]];

        return new self(
            "Validation failed for field '{$field}': {$message}",
            $errors,
            $validatedObject
        );
    }

    /**
     * Get the total number of validation errors.
     */
    public function getErrorCount(): int
    {
        return array_sum(array_map('count', $this->errors));
    }

    /**
     * Get all validation errors.
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Get errors for a specific field.
     */
    public function getFieldErrors(string $field): array
    {
        return $this->errors[$field] ?? [];
    }

    /**
     * Get the object that failed validation.
     */
    public function getValidatedObject(): ?string
    {
        return $this->validatedObject;
    }

    /**
     * Check if there are any validation errors.
     */
    public function hasErrors(): bool
    {
        return ! empty($this->errors);
    }

    /**
     * Check if a specific field has errors.
     */
    public function hasFieldError(string $field): bool
    {
        return ! empty($this->errors[$field]);
    }

    /**
     * Create a validation exception for invalid format.
     */
    public static function invalidFormat(
        string $field,
        string $expectedFormat,
        ?string $validatedObject = null
    ): self {
        return self::fieldValidation(
            $field,
            "Field '{$field}' must be in format: {$expectedFormat}",
            'INVALID_FORMAT',
            $validatedObject
        );
    }

    /**
     * Create a validation exception for multiple fields.
     */
    public static function multipleFields(
        array $errors,
        ?string $validatedObject = null
    ): self {
        $message = 'Validation failed for multiple fields';

        return new self($message, $errors, $validatedObject);
    }

    /**
     * Create a validation exception for value out of range.
     */
    public static function outOfRange(
        string $field,
        mixed $value,
        mixed $min,
        mixed $max,
        ?string $validatedObject = null
    ): self {
        return self::fieldValidation(
            $field,
            "Field '{$field}' value '{$value}' is out of range [{$min}, {$max}]",
            'OUT_OF_RANGE',
            $validatedObject
        );
    }

    /**
     * Create a validation exception for required field.
     */
    public static function requiredField(
        string $field,
        ?string $validatedObject = null
    ): self {
        return self::fieldValidation(
            $field,
            "Field '{$field}' is required",
            'REQUIRED',
            $validatedObject
        );
    }
}
