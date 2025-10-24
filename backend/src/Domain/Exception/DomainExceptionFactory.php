<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\Exception\Soap\SoapCallFailedException;

/**
 * Factory for creating domain exceptions with common patterns.
 *
 * This factory provides convenient methods for creating domain exceptions
 * with consistent error codes and context.
 */
final class DomainExceptionFactory
{
    /**
     * Create a business rule exception for authentication operations.
     */
    public static function authenticationBusinessRule(
        string $rule,
        string $message,
        array $context = []
    ): BusinessRuleException {
        return BusinessRuleException::authenticationRuleViolation($message, $rule, $context);
    }

    /**
     * Create a validation exception for DTO validation.
     */
    public static function dtoValidation(
        string $dtoClass,
        array $errors
    ): ValidationException {
        return ValidationException::multipleFields($errors, $dtoClass);
    }

    public static function insufficientPermissions(string $action, int $userId): BusinessRuleException
    {
        return self::userBusinessRule(
            'INSUFFICIENT_PERMISSIONS',
            "User {$userId} does not have permission to perform action: {$action}",
            null,
            ['user_id' => $userId, 'action' => $action]
        );
    }

    public static function invalidCredentials(): BusinessRuleException
    {
        return self::authenticationBusinessRule(
            'INVALID_CREDENTIALS',
            'Invalid username or password'
        );
    }

    /**
     * Create a validation exception for invalid format.
     */
    public static function invalidFormat(
        string $field,
        string $expectedFormat,
        ?string $objectClass = null
    ): ValidationException {
        return ValidationException::invalidFormat($field, $expectedFormat, $objectClass);
    }

    /**
     * Create a validation exception for out of range value.
     */
    public static function outOfRange(
        string $field,
        mixed $value,
        mixed $min,
        mixed $max,
        ?string $objectClass = null
    ): ValidationException {
        return ValidationException::outOfRange($field, $value, $min, $max, $objectClass);
    }

    /**
     * Create a validation exception for required field.
     */
    public static function requiredField(
        string $field,
        ?string $objectClass = null
    ): ValidationException {
        return ValidationException::requiredField($field, $objectClass);
    }

    /**
     * Create a business rule exception for session operations.
     */
    public static function sessionBusinessRule(
        string $rule,
        string $message,
        array $context = []
    ): BusinessRuleException {
        return BusinessRuleException::sessionRuleViolation($message, $rule, $context);
    }

    public static function sessionExpired(string $sessionId): BusinessRuleException
    {
        return self::sessionBusinessRule(
            'SESSION_EXPIRED',
            "Session {$sessionId} has expired",
            ['session_id' => $sessionId]
        );
    }

    public static function sessionNotFound(string $sessionId): BusinessRuleException
    {
        return self::sessionBusinessRule(
            'SESSION_NOT_FOUND',
            "Session {$sessionId} not found",
            ['session_id' => $sessionId]
        );
    }

    public static function soapCallFailed(string $operation, string $message, array $context = []): SoapCallFailedException
    {
        return SoapCallFailedException::fromOperation($operation, $message, $context);
    }

    public static function userAlreadyAuthenticated(int $userId): BusinessRuleException
    {
        return self::authenticationBusinessRule(
            'USER_ALREADY_AUTHENTICATED',
            "User {$userId} is already authenticated",
            ['user_id' => $userId]
        );
    }

    /**
     * Create a business rule exception for user operations.
     */
    public static function userBusinessRule(
        string $rule,
        string $message,
        ?string $field = null,
        array $context = []
    ): BusinessRuleException {
        return BusinessRuleException::userRuleViolation($message, $rule, $field, $context);
    }

    /**
     * Common business rules.
     */
    public static function userNotFound(int $userId): BusinessRuleException
    {
        return self::userBusinessRule(
            'USER_NOT_FOUND',
            "User with ID {$userId} not found",
            null,
            ['user_id' => $userId]
        );
    }
}
