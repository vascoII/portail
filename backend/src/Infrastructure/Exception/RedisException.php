<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

/**
 * Exception for Redis-related errors.
 *
 * This exception represents failures when interacting with Redis,
 * such as connection failures, command errors, or serialization issues.
 */
final class RedisException extends InfrastructureException
{
    /**
     * Redis command that failed.
     */
    private string $command = '';

    /**
     * Redis key that was being accessed.
     */
    private ?string $key = null;

    /**
     * Redis error code.
     */
    private ?string $redisErrorCode = null;

    public function __construct(
        string $message,
        string $command,
        ?string $key = null,
        ?string $redisErrorCode = null,
        array $context = [],
        array $technicalDetails = [],
        ?\Exception $previous = null
    ) {
        $technicalDetails['redis_error_code'] = $redisErrorCode;
        $technicalDetails['command'] = $command;
        if ($key) {
            $technicalDetails['key'] = $key;
        }

        parent::__construct(
            $message,
            'Redis',
            $command,
            'REDIS_ERROR',
            $context,
            $technicalDetails,
            $previous
        );

        $this->command = $command;
        $this->key = $key;
        $this->redisErrorCode = $redisErrorCode;
    }

    /**
     * Create for command failure.
     */
    public static function commandFailure(
        string $command,
        string $key,
        string $error,
        ?string $redisErrorCode = null
    ): self {
        return new self(
            "Redis command '{$command}' failed for key '{$key}': {$error}",
            $command,
            $key,
            $redisErrorCode
        );
    }

    /**
     * Create for connection failure.
     */
    public static function connectionFailure(
        string $host,
        int $port,
        ?\Exception $previous = null
    ): self {
        return new self(
            "Failed to connect to Redis at {$host}:{$port}",
            'CONNECT',
            null,
            'CONNECTION_ERROR',
            ['host' => $host, 'port' => $port],
            [],
            $previous
        );
    }

    /**
     * Create for deserialization failure.
     */
    public static function deserializationFailure(
        string $command,
        string $key,
        ?\Exception $previous = null
    ): self {
        return new self(
            "Failed to deserialize data from Redis key '{$key}'",
            $command,
            $key,
            'DESERIALIZATION_ERROR',
            [],
            [],
            $previous
        );
    }

    /**
     * Create from Predis exception.
     */
    public static function fromPredisException(
        \Exception $predisException,
        string $command,
        ?string $key = null
    ): self {
        $redisErrorCode = null;

        // Try to extract Redis error code from exception message
        if (preg_match('/ERR (\w+)/', $predisException->getMessage(), $matches)) {
            $redisErrorCode = $matches[1];
        }

        return new self(
            $predisException->getMessage(),
            $command,
            $key,
            $redisErrorCode,
            [],
            [],
            $predisException
        );
    }

    /**
     * Get the Redis command that failed.
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * Get the Redis key that was being accessed.
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * Get maximum retry attempts.
     */
    public function getMaxRetries(): int
    {
        return 3;
    }

    /**
     * Get the Redis error code.
     */
    public function getRedisErrorCode(): ?string
    {
        return $this->redisErrorCode;
    }

    /**
     * Get suggested retry delay in seconds.
     */
    public function getRetryDelay(): int
    {
        return 1; // Short delay for Redis operations
    }

    /**
     * Check if this is a retryable error.
     */
    public function isRetryable(): bool
    {
        // Retry on connection errors, timeouts, and temporary failures
        $retryableErrors = [
            'CONNECTION_ERROR',
            'TIMEOUT',
            'BUSY',
            'LOADING',
        ];

        return in_array($this->redisErrorCode, $retryableErrors, true)
          || str_contains(strtolower($this->getMessage()), 'connection')
          || str_contains(strtolower($this->getMessage()), 'timeout');
    }

    /**
     * Create for serialization failure.
     */
    public static function serializationFailure(
        string $command,
        string $key,
        ?\Exception $previous = null
    ): self {
        return new self(
            "Failed to serialize data for Redis key '{$key}'",
            $command,
            $key,
            'SERIALIZATION_ERROR',
            [],
            [],
            $previous
        );
    }
}
