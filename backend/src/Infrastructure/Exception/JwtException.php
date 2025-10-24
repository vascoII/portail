<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

/**
 * Exception for JWT-related errors.
 *
 * This exception represents failures when working with JWT tokens,
 * such as token generation, validation, or parsing errors.
 */
final class JwtException extends InfrastructureException
{
    /**
     * JWT algorithm used.
     */
    private ?string $algorithm = null;

    /**
     * JWT error type.
     */
    private string $jwtErrorType = '';

    /**
     * JWT token that caused the error (truncated for security).
     */
    private ?string $token = null;

    public function __construct(
        string $message,
        string $jwtErrorType,
        ?string $token = null,
        ?string $algorithm = null,
        array $context = [],
        array $technicalDetails = [],
        ?\Exception $previous = null
    ) {
        $technicalDetails['jwt_error_type'] = $jwtErrorType;
        if ($algorithm) {
            $technicalDetails['algorithm'] = $algorithm;
        }
        if ($token) {
            $technicalDetails['token_prefix'] = substr($token, 0, 10) . '...';
        }

        parent::__construct(
            $message,
            'JWT',
            'token_operation',
            'JWT_ERROR',
            $context,
            $technicalDetails,
            $previous
        );

        $this->token = $token;
        $this->jwtErrorType = $jwtErrorType;
        $this->algorithm = $algorithm;
    }

    /**
     * Get the JWT algorithm.
     */
    public function getAlgorithm(): ?string
    {
        return $this->algorithm;
    }

    /**
     * Get the JWT error type.
     */
    public function getJwtErrorType(): string
    {
        return $this->jwtErrorType;
    }

    /**
     * Get maximum retry attempts.
     */
    public function getMaxRetries(): int
    {
        return 0;
    }

    /**
     * Get suggested retry delay in seconds.
     */
    public function getRetryDelay(): int
    {
        return 0;
    }

    /**
     * Get the JWT token (truncated for security).
     */
    public function getToken(): ?string
    {
        return $this->token ? substr($this->token, 0, 10) . '...' : null;
    }

    /**
     * Create for invalid algorithm.
     */
    public static function invalidAlgorithm(
        string $token,
        string $expectedAlgorithm,
        string $actualAlgorithm
    ): self {
        return new self(
            "JWT token uses invalid algorithm. Expected: {$expectedAlgorithm}, Got: {$actualAlgorithm}",
            'INVALID_ALGORITHM',
            $token,
            $actualAlgorithm,
            [
                'expected_algorithm' => $expectedAlgorithm,
                'actual_algorithm' => $actualAlgorithm,
            ],
            []
        );
    }

    /**
     * Create for invalid signature.
     */
    public static function invalidSignature(
        string $token,
        ?string $algorithm = null
    ): self {
        return new self(
            'JWT token has invalid signature',
            'INVALID_SIGNATURE',
            $token,
            $algorithm,
            [],
            []
        );
    }

    /**
     * Check if this is a retryable error.
     */
    public function isRetryable(): bool
    {
        // JWT errors are generally not retryable
        return false;
    }

    /**
     * Create for malformed token.
     */
    public static function malformedToken(
        string $token
    ): self {
        return new self(
            'JWT token is malformed',
            'MALFORMED_TOKEN',
            $token,
            null,
            [],
            []
        );
    }

    /**
     * Create for missing token.
     */
    public static function missingToken(): self
    {
        return new self(
            'JWT token is missing',
            'MISSING_TOKEN',
            null,
            null,
            [],
            []
        );
    }

    /**
     * Create for token expiration.
     */
    public static function tokenExpired(
        string $token,
        ?string $algorithm = null
    ): self {
        return new self(
            'JWT token has expired',
            'TOKEN_EXPIRED',
            $token,
            $algorithm,
            [],
            []
        );
    }

    /**
     * Create for token generation failure.
     */
    public static function tokenGenerationFailure(
        ?\Exception $previous = null
    ): self {
        return new self(
            'Failed to generate JWT token',
            'GENERATION_FAILED',
            null,
            null,
            [],
            [],
            $previous
        );
    }

    /**
     * Create for token parsing failure.
     */
    public static function tokenParsingFailure(
        string $token,
        ?\Exception $previous = null
    ): self {
        return new self(
            'Failed to parse JWT token',
            'PARSING_FAILED',
            $token,
            null,
            [],
            [],
            $previous
        );
    }

    /**
     * Create for token validation failure.
     */
    public static function tokenValidationFailure(
        string $token,
        string $reason,
        ?string $algorithm = null,
        ?\Exception $previous = null
    ): self {
        return new self(
            "JWT token validation failed: {$reason}",
            'VALIDATION_FAILED',
            $token,
            $algorithm,
            ['reason' => $reason],
            [],
            $previous
        );
    }
}
