<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

/**
 * Factory for creating infrastructure exceptions with common patterns
 */
final class InfrastructureExceptionFactory
{
  /**
   * SOAP Transport Exceptions
   */
  public static function soapConnectionTimeout(
    string $service,
    string $method,
    string $wsdlUrl,
    int $timeout
  ): SoapTransportException {
    return new SoapTransportException(
      "SOAP connection timeout after {$timeout} seconds",
      $service,
      $method,
      $wsdlUrl,
      408, // Request Timeout
      $timeout,
      0,
      [],
      [],
      ['timeout_seconds' => $timeout]
    );
  }

  public static function soapConnectionFailed(
    string $service,
    string $method,
    string $wsdlUrl,
    string $error
  ): SoapTransportException {
    return new SoapTransportException(
      "SOAP connection failed: {$error}",
      $service,
      $method,
      $wsdlUrl,
      503, // Service Unavailable
      null,
      0,
      [],
      [],
      ['connection_error' => $error]
    );
  }

  public static function soapHttpError(
    string $service,
    string $method,
    int $httpStatusCode,
    string $wsdlUrl = ''
  ): SoapTransportException {
    $message = "SOAP HTTP error: {$httpStatusCode}";

    return new SoapTransportException(
      $message,
      $service,
      $method,
      $wsdlUrl,
      $httpStatusCode,
      null,
      0,
      [],
      [],
      ['http_status' => $httpStatusCode]
    );
  }

  /**
   * SOAP Business Exceptions
   */
  public static function soapAuthenticationFailed(
    string $service,
    string $method,
    string $wsdlUrl = ''
  ): SoapBusinessException {
    return new SoapBusinessException(
      'SOAP authentication failed',
      $service,
      $method,
      'AUTHENTICATION_FAILED',
      'Invalid credentials or session expired',
      $wsdlUrl,
      null,
      null,
      [],
      []
    );
  }

  public static function soapValidationError(
    string $service,
    string $method,
    string $field,
    string $error,
    string $wsdlUrl = ''
  ): SoapBusinessException {
    return new SoapBusinessException(
      "SOAP validation error for field '{$field}': {$error}",
      $service,
      $method,
      'VALIDATION_ERROR',
      $error,
      $wsdlUrl,
      null,
      null,
      [],
      [],
      ['field' => $field]
    );
  }

  public static function soapBusinessRuleViolation(
    string $service,
    string $method,
    string $rule,
    string $message,
    string $wsdlUrl = ''
  ): SoapBusinessException {
    return new SoapBusinessException(
      "SOAP business rule violation: {$message}",
      $service,
      $method,
      'BUSINESS_RULE_VIOLATION',
      $rule,
      $wsdlUrl,
      null,
      null,
      [],
      [],
      ['rule' => $rule]
    );
  }

  /**
   * Redis Exceptions
   */
  public static function redisConnectionFailed(
    string $host,
    int $port,
    ?\Exception $previous = null
  ): RedisException {
    return RedisException::connectionFailure($host, $port, $previous);
  }

  public static function redisSessionNotFound(
    string $sessionId
  ): RedisException {
    return new RedisException(
      "Session not found in Redis: {$sessionId}",
      'GET',
      "session:{$sessionId}",
      'KEY_NOT_FOUND',
      ['session_id' => $sessionId]
    );
  }

  public static function redisSessionStoreFailed(
    string $sessionId,
    ?\Exception $previous = null
  ): RedisException {
    return new RedisException(
      "Failed to store session in Redis: {$sessionId}",
      'SETEX',
      "session:{$sessionId}",
      'STORE_FAILED',
      ['session_id' => $sessionId],
      [],
      $previous
    );
  }

  public static function redisSessionDeleteFailed(
    string $sessionId,
    ?\Exception $previous = null
  ): RedisException {
    return new RedisException(
      "Failed to delete session from Redis: {$sessionId}",
      'DEL',
      "session:{$sessionId}",
      'DELETE_FAILED',
      ['session_id' => $sessionId],
      [],
      $previous
    );
  }

  /**
   * JWT Exceptions
   */
  public static function jwtTokenExpired(
    string $token
  ): JwtException {
    return JwtException::tokenExpired($token);
  }

  public static function jwtInvalidSignature(
    string $token
  ): JwtException {
    return JwtException::invalidSignature($token);
  }

  public static function jwtMalformedToken(
    string $token
  ): JwtException {
    return JwtException::malformedToken($token);
  }

  public static function jwtMissingToken(): JwtException
  {
    return JwtException::missingToken();
  }

  public static function jwtGenerationFailed(
    ?\Exception $previous = null
  ): JwtException {
    return JwtException::tokenGenerationFailure($previous);
  }

  /**
   * Generic Infrastructure Exceptions
   */
  public static function serviceUnavailable(
    string $service,
    string $operation,
    ?\Exception $previous = null
  ): InfrastructureException {
    return new InfrastructureException(
      "Service '{$service}' is unavailable for operation '{$operation}'",
      $service,
      $operation,
      'SERVICE_UNAVAILABLE',
      [],
      [],
      $previous
    );
  }

  public static function configurationError(
    string $service,
    string $configKey,
    string $expectedType
  ): InfrastructureException {
    return new InfrastructureException(
      "Configuration error for '{$configKey}' in service '{$service}'. Expected: {$expectedType}",
      $service,
      'configuration',
      'CONFIGURATION_ERROR',
      ['config_key' => $configKey, 'expected_type' => $expectedType]
    );
  }

  public static function externalServiceError(
    string $service,
    string $operation,
    string $externalService,
    ?\Exception $previous = null
  ): InfrastructureException {
    return new InfrastructureException(
      "External service '{$externalService}' error during '{$operation}' in '{$service}'",
      $service,
      $operation,
      'EXTERNAL_SERVICE_ERROR',
      ['external_service' => $externalService],
      [],
      $previous
    );
  }
}
