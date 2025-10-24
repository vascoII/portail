<?php

declare(strict_types=1);

namespace App\Http\Exception;

/**
 * Exception for authorization failures.
 *
 * This exception represents authorization failures and maps to HTTP 403.
 */
final class AuthorizationException extends HttpException
{
    public function __construct(
        string $message = 'Access denied',
        string $component = 'Authorization',
        string $operation = 'authorize',
        array $context = [],
        array $inputData = [],
        array $headers = [],
        ?\Exception $previous = null
    ) {
        parent::__construct(
            $message,
            403,
            'Forbidden',
            $component,
            $operation,
            'AUTHORIZATION_FAILED',
            $context,
            $inputData,
            [],
            $headers,
            $previous
        );
    }

    /**
     * Create for client access denied.
     */
    public static function clientAccessDenied(
        string $clientId,
        ?int $userId = null
    ): self {
        $context = [
            'reason' => 'client_access_denied',
            'client_id' => $clientId,
        ];

        if ($userId) {
            $context['user_id'] = $userId;
        }

        return new self(
            "Access denied for client: {$clientId}",
            'Authorization',
            'check_client_access',
            $context
        );
    }

    /**
     * Create for feature access denied.
     */
    public static function featureAccessDenied(
        string $feature,
        ?int $userId = null
    ): self {
        $context = [
            'reason' => 'feature_access_denied',
            'feature' => $feature,
        ];

        if ($userId) {
            $context['user_id'] = $userId;
        }

        return new self(
            "Access denied to feature: {$feature}",
            'Authorization',
            'check_feature_access',
            $context
        );
    }

    /**
     * Get user-friendly error message.
     */
    public function getApiMessage(): string
    {
        return match ($this->context['reason'] ?? '') {
            'insufficient_permissions' => 'You do not have permission to perform this action',
            'resource_access_denied' => 'Access denied to this resource',
            'role_access_denied' => 'Your role does not allow access to this resource',
            'client_access_denied' => 'Access denied for your client',
            'feature_access_denied' => 'This feature is not available for your account',
            'rate_limited' => 'Too many requests. Please try again later',
            'ip_access_denied' => 'Access denied from your IP address',
            'time_access_denied' => 'Access denied due to time restrictions',
            default => 'Access denied',
        };
    }

    /**
     * Create for insufficient permissions.
     */
    public static function insufficientPermissions(
        string $action,
        ?int $userId = null,
        ?string $resource = null
    ): self {
        $context = [
            'reason' => 'insufficient_permissions',
            'action' => $action,
        ];

        if ($userId) {
            $context['user_id'] = $userId;
        }

        if ($resource) {
            $context['resource'] = $resource;
        }

        return new self(
            "Insufficient permissions to perform action: {$action}",
            'Authorization',
            'check_permissions',
            $context
        );
    }

    /**
     * Create for IP-based access denied.
     */
    public static function ipAccessDenied(
        string $ip,
        ?int $userId = null
    ): self {
        $context = [
            'reason' => 'ip_access_denied',
            'ip' => $ip,
        ];

        if ($userId) {
            $context['user_id'] = $userId;
        }

        return new self(
            "Access denied from IP: {$ip}",
            'Authorization',
            'check_ip_access',
            $context
        );
    }

    /**
     * Create for rate limiting.
     */
    public static function rateLimited(
        string $action,
        int $limit,
        int $window
    ): self {
        return new self(
            "Rate limit exceeded for action: {$action}",
            'Authorization',
            'check_rate_limit',
            [
                'reason' => 'rate_limited',
                'action' => $action,
                'limit' => $limit,
                'window' => $window,
            ],
            [],
            [
                'X-RateLimit-Limit' => (string) $limit,
                'X-RateLimit-Window' => (string) $window,
                'Retry-After' => (string) $window,
            ]
        );
    }

    /**
     * Create for resource access denied.
     */
    public static function resourceAccessDenied(
        string $resource,
        ?int $userId = null,
        ?string $action = null
    ): self {
        $context = [
            'reason' => 'resource_access_denied',
            'resource' => $resource,
        ];

        if ($userId) {
            $context['user_id'] = $userId;
        }

        if ($action) {
            $context['action'] = $action;
        }

        $message = "Access denied to resource: {$resource}";
        if ($action) {
            $message .= " for action: {$action}";
        }

        return new self(
            $message,
            'Authorization',
            'check_resource_access',
            $context
        );
    }

    /**
     * Create for role-based access denied.
     */
    public static function roleAccessDenied(
        string $requiredRole,
        ?string $userRole = null,
        ?int $userId = null
    ): self {
        $context = [
            'reason' => 'role_access_denied',
            'required_role' => $requiredRole,
        ];

        if ($userRole) {
            $context['user_role'] = $userRole;
        }

        if ($userId) {
            $context['user_id'] = $userId;
        }

        return new self(
            "Access denied. Required role: {$requiredRole}",
            'Authorization',
            'check_role',
            $context
        );
    }

    /**
     * Create for time-based access denied.
     */
    public static function timeAccessDenied(
        string $timeRestriction,
        ?int $userId = null
    ): self {
        $context = [
            'reason' => 'time_access_denied',
            'time_restriction' => $timeRestriction,
        ];

        if ($userId) {
            $context['user_id'] = $userId;
        }

        return new self(
            "Access denied due to time restriction: {$timeRestriction}",
            'Authorization',
            'check_time_access',
            $context
        );
    }
}
