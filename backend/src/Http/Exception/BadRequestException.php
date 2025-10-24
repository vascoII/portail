<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Domain\Exception\ValidationException;

/**
 * Exception for bad request errors.
 *
 * This exception represents client-side errors and maps to HTTP 400.
 */
final class BadRequestException extends HttpException
{
    public function __construct(
        string $message = 'Bad request',
        string $component = 'HTTP',
        string $operation = 'validate_request',
        array $context = [],
        array $inputData = [],
        array $headers = [],
        ?\Exception $previous = null
    ) {
        parent::__construct(
            $message,
            400,
            'Bad Request',
            $component,
            $operation,
            'BAD_REQUEST',
            $context,
            $inputData,
            [],
            $headers,
            $previous
        );
    }

    /**
     * Create from ValidationException.
     */
    public static function fromValidationException(ValidationException $validationException): self
    {
        $errors = $validationException->getErrors();
        $fieldErrors = [];

        foreach ($errors as $field => $fieldErrorList) {
            $fieldErrors[$field] = array_map(fn ($error) => $error['message'], $fieldErrorList);
        }

        return new self(
            'Validation failed',
            'HTTP',
            'validate_request',
            [
                'reason' => 'validation_failed',
                'validation_errors' => $fieldErrors,
                'error_count' => $validationException->getErrorCount(),
            ],
            $validationException->getContext(),
            [],
            $validationException
        );
    }

    /**
     * Get user-friendly error message.
     */
    public function getApiMessage(): string
    {
        return match ($this->context['reason'] ?? '') {
            'missing_field' => 'Required field is missing',
            'invalid_field_format' => 'Invalid field format',
            'invalid_field_value' => 'Invalid field value',
            'malformed_json' => 'Invalid JSON format',
            'unsupported_content_type' => 'Unsupported content type',
            'request_too_large' => 'Request too large',
            'invalid_method' => 'Invalid HTTP method',
            'missing_header' => 'Required header is missing',
            'invalid_header_value' => 'Invalid header value',
            'validation_failed' => 'Request validation failed',
            default => 'Bad request',
        };
    }

    /**
     * Create for invalid field format.
     */
    public static function invalidFieldFormat(string $field, string $expectedFormat): self
    {
        return new self(
            "Invalid format for field '{$field}'. Expected: {$expectedFormat}",
            'HTTP',
            'validate_request',
            [
                'reason' => 'invalid_field_format',
                'field' => $field,
                'expected_format' => $expectedFormat,
            ]
        );
    }

    /**
     * Create for invalid field value.
     */
    public static function invalidFieldValue(string $field, mixed $value, string $reason = ''): self
    {
        $message = "Invalid value for field '{$field}'";
        if ($reason) {
            $message .= ": {$reason}";
        }

        return new self(
            $message,
            'HTTP',
            'validate_request',
            [
                'reason' => 'invalid_field_value',
                'field' => $field,
                'value' => $value,
                'details' => $reason,
            ]
        );
    }

    /**
     * Create for invalid header value.
     */
    public static function invalidHeaderValue(string $header, string $value, string $reason = ''): self
    {
        $message = "Invalid value for header '{$header}'";
        if ($reason) {
            $message .= ": {$reason}";
        }

        return new self(
            $message,
            'HTTP',
            'validate_headers',
            [
                'reason' => 'invalid_header_value',
                'header' => $header,
                'value' => $value,
                'details' => $reason,
            ]
        );
    }

    /**
     * Create for invalid HTTP method.
     */
    public static function invalidMethod(string $method, array $allowedMethods = []): self
    {
        $message = "Invalid HTTP method: {$method}";
        if (! empty($allowedMethods)) {
            $message .= '. Allowed methods: ' . implode(', ', $allowedMethods);
        }

        return new self(
            $message,
            'HTTP',
            'validate_method',
            [
                'reason' => 'invalid_method',
                'method' => $method,
                'allowed_methods' => $allowedMethods,
            ],
            [],
            [
                'Allow' => implode(', ', $allowedMethods),
            ]
        );
    }

    /**
     * Create for malformed JSON.
     */
    public static function malformedJson(string $jsonError = ''): self
    {
        $message = 'Malformed JSON in request body';
        if ($jsonError) {
            $message .= ": {$jsonError}";
        }

        return new self(
            $message,
            'HTTP',
            'parse_request',
            [
                'reason' => 'malformed_json',
                'json_error' => $jsonError,
            ]
        );
    }

    /**
     * Create for missing required field.
     */
    public static function missingField(string $field): self
    {
        return new self(
            "Missing required field: {$field}",
            'HTTP',
            'validate_request',
            [
                'reason' => 'missing_field',
                'field' => $field,
            ]
        );
    }

    /**
     * Create for missing required header.
     */
    public static function missingHeader(string $header): self
    {
        return new self(
            "Missing required header: {$header}",
            'HTTP',
            'validate_headers',
            [
                'reason' => 'missing_header',
                'header' => $header,
            ]
        );
    }

    /**
     * Create for invalid request size.
     */
    public static function requestTooLarge(int $size, int $maxSize): self
    {
        return new self(
            "Request too large. Size: {$size} bytes, Max: {$maxSize} bytes",
            'HTTP',
            'validate_request_size',
            [
                'reason' => 'request_too_large',
                'size' => $size,
                'max_size' => $maxSize,
            ]
        );
    }

    /**
     * Convert to array for API response with validation details.
     */
    public function toApiResponse(): array
    {
        $response = parent::toApiResponse();

        // Add validation errors if present
        if (isset($this->context['validation_errors'])) {
            $response['error']['validation_errors'] = $this->context['validation_errors'];
        }

        return $response;
    }

    /**
     * Create for unsupported content type.
     */
    public static function unsupportedContentType(string $contentType): self
    {
        return new self(
            "Unsupported content type: {$contentType}",
            'HTTP',
            'validate_content_type',
            [
                'reason' => 'unsupported_content_type',
                'content_type' => $contentType,
            ]
        );
    }

    /**
     * Create for multiple validation errors.
     */
    public static function validationFailed(array $errors): self
    {
        $fieldErrors = [];
        foreach ($errors as $field => $messages) {
            $fieldErrors[$field] = is_array($messages) ? $messages : [$messages];
        }

        return new self(
            'Validation failed',
            'HTTP',
            'validate_request',
            [
                'reason' => 'validation_failed',
                'validation_errors' => $fieldErrors,
                'error_count' => array_sum(array_map('count', $fieldErrors)),
            ]
        );
    }
}
