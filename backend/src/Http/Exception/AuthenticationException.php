<?php

declare(strict_types=1);

namespace App\Http\Exception;

/**
 * Exception for authentication failures.
 *
 * This exception represents authentication failures and maps to HTTP 401.
 */
final class AuthenticationException extends HttpException
{
    public function __construct(
        string $message = 'Authentication failed',
        string $component = 'Authentication',
        string $operation = 'authenticate',
        array $context = [],
        array $inputData = [],
        array $headers = [],
        ?\Exception $previous = null
    ) {
        parent::__construct(
            $message,
            401,
            'Unauthorized',
            $component,
            $operation,
            'AUTHENTICATION_FAILED',
            $context,
            $inputData,
            [],
            $headers,
            $previous
        );
    }

    /**
     * Create for account disabled.
     */
    public static function accountDisabled(): self
    {
        return new self(
            'Account is disabled',
            'Authentication',
            'login',
            ['reason' => 'account_disabled']
        );
    }

    /**
     * Create for account locked.
     */
    public static function accountLocked(): self
    {
        return new self(
            'Account is locked',
            'Authentication',
            'login',
            ['reason' => 'account_locked']
        );
    }

    /**
     * Create for expired authentication token.
     */
    public static function expiredToken(): self
    {
        return new self(
            'Authentication token has expired',
            'Authentication',
            'validate_token',
            ['reason' => 'expired_token']
        );
    }

    /**
     * Get user-friendly error message.
     */
    public function getApiMessage(): string
    {
        // Don't expose technical details for authentication failures
        return match ($this->context['reason'] ?? '') {
            'missing_token' => 'Authentication required',
            'invalid_token' => 'Invalid authentication token',
            'expired_token' => 'Authentication token has expired',
            'malformed_token' => 'Invalid authentication token format',
            'session_not_found' => 'User session not found',
            'session_expired' => 'User session has expired',
            'invalid_credentials' => 'Invalid username or password',
            'account_locked' => 'Account is locked',
            'account_disabled' => 'Account is disabled',
            'service_failure' => 'Authentication service temporarily unavailable',
            default => 'Authentication failed',
        };
    }

    /**
     * Create for invalid credentials.
     */
    public static function invalidCredentials(): self
    {
        return new self(
            'Invalid username or password',
            'Authentication',
            'login',
            ['reason' => 'invalid_credentials']
        );
    }

    /**
     * Create for invalid authentication token.
     */
    public static function invalidToken(string $reason = ''): self
    {
        $message = 'Authentication token is invalid';
        if ($reason) {
            $message .= ": {$reason}";
        }

        return new self(
            $message,
            'Authentication',
            'validate_token',
            ['reason' => 'invalid_token', 'details' => $reason]
        );
    }

    /**
     * Create for malformed authentication token.
     */
    public static function malformedToken(): self
    {
        return new self(
            'Authentication token is malformed',
            'Authentication',
            'validate_token',
            ['reason' => 'malformed_token']
        );
    }

    /**
     * Create for missing authentication token.
     */
    public static function missingToken(): self
    {
        return new self(
            'Authentication token is missing',
            'Authentication',
            'validate_token',
            ['reason' => 'missing_token']
        );
    }

    /**
     * Create for authentication service failure.
     */
    public static function serviceFailure(string $service, string $reason, ?\Exception $previous = null): self
    {
        return new self(
            "Authentication service '{$service}' failed: {$reason}",
            'Authentication',
            'service_call',
            [
                'reason' => 'service_failure',
                'service' => $service,
                'service_reason' => $reason,
            ],
            [],
            [],
            $previous
        );
    }

    /**
     * Create for session expired.
     */
    public static function sessionExpired(string $sessionId = ''): self
    {
        $message = 'User session has expired';
        $context = ['reason' => 'session_expired'];

        if ($sessionId) {
            $context['session_id_prefix'] = substr($sessionId, 0, 8) . '...';
        }

        return new self(
            $message,
            'Authentication',
            'validate_session',
            $context
        );
    }

    /**
     * Create for session not found.
     */
    public static function sessionNotFound(string $sessionId = ''): self
    {
        $message = 'User session not found';
        $context = ['reason' => 'session_not_found'];

        if ($sessionId) {
            $context['session_id_prefix'] = substr($sessionId, 0, 8) . '...';
        }

        return new self(
            $message,
            'Authentication',
            'validate_session',
            $context
        );
    }
}
