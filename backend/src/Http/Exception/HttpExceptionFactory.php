<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Application\Exception\ApplicationException;
use App\Domain\Exception\DomainException;
use App\Infrastructure\Exception\InfrastructureException;

/**
 * Factory for creating HTTP exceptions with common patterns
 */
final class HttpExceptionFactory
{
  /**
   * Authentication Exceptions
   */
  public static function authenticationFailed(string $reason = ''): AuthenticationException
  {
    return AuthenticationException::invalidToken($reason);
  }

  public static function tokenExpired(): AuthenticationException
  {
    return AuthenticationException::expiredToken();
  }

  public static function tokenMissing(): AuthenticationException
  {
    return AuthenticationException::missingToken();
  }

  public static function sessionNotFound(string $sessionId = ''): AuthenticationException
  {
    return AuthenticationException::sessionNotFound($sessionId);
  }

  public static function sessionExpired(string $sessionId = ''): AuthenticationException
  {
    return AuthenticationException::sessionExpired($sessionId);
  }

  public static function invalidCredentials(): AuthenticationException
  {
    return AuthenticationException::invalidCredentials();
  }

  public static function accountLocked(): AuthenticationException
  {
    return AuthenticationException::accountLocked();
  }

  public static function accountDisabled(): AuthenticationException
  {
    return AuthenticationException::accountDisabled();
  }

  /**
   * Authorization Exceptions
   */
  public static function insufficientPermissions(
    string $action,
    ?int $userId = null,
    ?string $resource = null
  ): AuthorizationException {
    return AuthorizationException::insufficientPermissions($action, $userId, $resource);
  }

  public static function resourceAccessDenied(
    string $resource,
    ?int $userId = null,
    ?string $action = null
  ): AuthorizationException {
    return AuthorizationException::resourceAccessDenied($resource, $userId, $action);
  }

  public static function roleAccessDenied(
    string $requiredRole,
    ?string $userRole = null,
    ?int $userId = null
  ): AuthorizationException {
    return AuthorizationException::roleAccessDenied($requiredRole, $userRole, $userId);
  }

  public static function clientAccessDenied(
    string $clientId,
    ?int $userId = null
  ): AuthorizationException {
    return AuthorizationException::clientAccessDenied($clientId, $userId);
  }

  public static function featureAccessDenied(
    string $feature,
    ?int $userId = null
  ): AuthorizationException {
    return AuthorizationException::featureAccessDenied($feature, $userId);
  }

  public static function rateLimited(
    string $action,
    int $limit,
    int $window
  ): AuthorizationException {
    return AuthorizationException::rateLimited($action, $limit, $window);
  }

  /**
   * Bad Request Exceptions
   */
  public static function missingField(string $field): BadRequestException
  {
    return BadRequestException::missingField($field);
  }

  public static function invalidFieldFormat(string $field, string $expectedFormat): BadRequestException
  {
    return BadRequestException::invalidFieldFormat($field, $expectedFormat);
  }

  public static function invalidFieldValue(string $field, mixed $value, string $reason = ''): BadRequestException
  {
    return BadRequestException::invalidFieldValue($field, $value, $reason);
  }

  public static function malformedJson(string $jsonError = ''): BadRequestException
  {
    return BadRequestException::malformedJson($jsonError);
  }

  public static function unsupportedContentType(string $contentType): BadRequestException
  {
    return BadRequestException::unsupportedContentType($contentType);
  }

  public static function requestTooLarge(int $size, int $maxSize): BadRequestException
  {
    return BadRequestException::requestTooLarge($size, $maxSize);
  }

  public static function invalidMethod(string $method, array $allowedMethods = []): BadRequestException
  {
    return BadRequestException::invalidMethod($method, $allowedMethods);
  }

  public static function missingHeader(string $header): BadRequestException
  {
    return BadRequestException::missingHeader($header);
  }

  public static function invalidHeaderValue(string $header, string $value, string $reason = ''): BadRequestException
  {
    return BadRequestException::invalidHeaderValue($header, $value, $reason);
  }

  /**
   * Internal Server Error Exceptions
   */
  public static function unexpectedError(
    string $component,
    string $operation,
    ?\Exception $previous = null
  ): InternalServerErrorException {
    return InternalServerErrorException::unexpectedError($component, $operation, $previous);
  }

  public static function serviceUnavailable(
    string $service,
    string $reason = '',
    ?\Exception $previous = null
  ): InternalServerErrorException {
    return InternalServerErrorException::serviceUnavailable($service, $reason, $previous);
  }

  public static function databaseError(
    string $operation,
    string $reason = '',
    ?\Exception $previous = null
  ): InternalServerErrorException {
    return InternalServerErrorException::databaseError($operation, $reason, $previous);
  }

  public static function externalServiceError(
    string $service,
    string $operation,
    string $reason = '',
    ?\Exception $previous = null
  ): InternalServerErrorException {
    return InternalServerErrorException::externalServiceError($service, $operation, $reason, $previous);
  }

  public static function configurationError(
    string $configKey,
    string $reason = '',
    ?\Exception $previous = null
  ): InternalServerErrorException {
    return InternalServerErrorException::configurationError($configKey, $reason, $previous);
  }

  public static function memoryError(int $memoryLimit, int $currentUsage): InternalServerErrorException
  {
    return InternalServerErrorException::memoryError($memoryLimit, $currentUsage);
  }

  public static function timeoutError(string $operation, int $timeoutSeconds): InternalServerErrorException
  {
    return InternalServerErrorException::timeoutError($operation, $timeoutSeconds);
  }

  public static function fileSystemError(
    string $operation,
    string $path,
    string $reason = '',
    ?\Exception $previous = null
  ): InternalServerErrorException {
    return InternalServerErrorException::fileSystemError($operation, $path, $reason, $previous);
  }

  /**
   * Exception Mapping from Lower Layers
   */
  public static function fromDomainException(DomainException $domainException): HttpException
  {
    return match ($domainException->getErrorCode()) {
      'VALIDATION_FAILED' => BadRequestException::fromValidationException(
        $domainException instanceof \App\Domain\Exception\ValidationException
          ? $domainException
          : throw new \InvalidArgumentException('Expected ValidationException')
      ),
      'BUSINESS_RULE_VIOLATION' => new BadRequestException(
        $domainException->getMessage(),
        'Domain',
        'business_rule',
        $domainException->getContext(),
        [],
        [],
        $domainException
      ),
      default => new BadRequestException(
        $domainException->getMessage(),
        'Domain',
        'domain_logic',
        $domainException->getContext(),
        [],
        [],
        $domainException
      ),
    };
  }

  public static function fromApplicationException(ApplicationException $applicationException): HttpException
  {
    return match ($applicationException->getErrorCode()) {
      'USE_CASE_EXECUTION_FAILED' => new BadRequestException(
        $applicationException->getMessage(),
        $applicationException->getComponent(),
        $applicationException->getOperation(),
        $applicationException->getContext(),
        $applicationException->getInputData(),
        [],
        $applicationException
      ),
      'SERVICE_EXECUTION_FAILED' => InternalServerErrorException::fromApplicationException($applicationException),
      default => InternalServerErrorException::fromApplicationException($applicationException),
    };
  }

  public static function fromInfrastructureException(InfrastructureException $infrastructureException): HttpException
  {
    return match ($infrastructureException->getErrorCode()) {
      'SOAP_ERROR' => InternalServerErrorException::externalServiceError(
        $infrastructureException->getService(),
        $infrastructureException->getOperation(),
        $infrastructureException->getMessage(),
        $infrastructureException
      ),
      'REDIS_ERROR' => InternalServerErrorException::serviceUnavailable(
        'Redis',
        $infrastructureException->getMessage(),
        $infrastructureException
      ),
      'JWT_ERROR' => AuthenticationException::serviceFailure(
        'JWT',
        $infrastructureException->getMessage(),
        $infrastructureException
      ),
      default => InternalServerErrorException::externalServiceError(
        $infrastructureException->getService(),
        $infrastructureException->getOperation(),
        $infrastructureException->getMessage(),
        $infrastructureException
      ),
    };
  }

  /**
   * Generic Exception Mapping
   */
  public static function fromGenericException(\Exception $exception): HttpException
  {
    return InternalServerErrorException::unexpectedError(
      'Unknown',
      'unknown',
      $exception
    );
  }
}
