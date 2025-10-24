<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Exception;

/**
 * Exception thrown when a business rule is violated.
 *
 * This exception represents domain logic violations that are
 * part of the business rules and constraints.
 */
final class BusinessRuleException extends DomainException
{
    /**
     * The entity or object that violated the rule.
     */
    private ?string $entity = null;

    /**
     * The field or property that caused the violation.
     */
    private ?string $field = null;

    /**
     * The specific business rule that was violated.
     */
    private string $rule;

    public function __construct(
        string $message,
        string $rule,
        ?string $entity = null,
        ?string $field = null,
        array $context = [],
        ?\Exception $previous = null
    ) {
        $errorCode = 'BUSINESS_RULE_VIOLATION';

        // Add rule-specific context
        $context['rule'] = $rule;
        if ($entity) {
            $context['entity'] = $entity;
        }
        if ($field) {
            $context['field'] = $field;
        }

        parent::__construct($message, $errorCode, $context, $previous);

        $this->rule = $rule;
        $this->entity = $entity;
        $this->field = $field;
    }

    /**
     * Create a business rule exception for authentication-related violations.
     */
    public static function authenticationRuleViolation(
        string $message,
        string $rule,
        array $context = []
    ): self {
        return new self($message, $rule, 'Authentication', null, $context);
    }

    /**
     * Get the entity that violated the rule.
     */
    public function getEntity(): ?string
    {
        return $this->entity;
    }

    /**
     * Get the field that caused the violation.
     */
    public function getField(): ?string
    {
        return $this->field;
    }

    /**
     * Get the business rule that was violated.
     */
    public function getRule(): string
    {
        return $this->rule;
    }

    /**
     * Create a business rule exception for session-related violations.
     */
    public static function sessionRuleViolation(
        string $message,
        string $rule,
        array $context = []
    ): self {
        return new self($message, $rule, 'Session', null, $context);
    }

    /**
     * Create a business rule exception for user-related violations.
     */
    public static function userRuleViolation(
        string $message,
        string $rule,
        ?string $field = null,
        array $context = []
    ): self {
        return new self($message, $rule, 'User', $field, $context);
    }
}
