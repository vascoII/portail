<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

/**
 * Exception for SOAP transport/network errors
 * 
 * This exception represents network-related failures when calling SOAP services,
 * such as connection timeouts, DNS resolution failures, or HTTP errors.
 */
final class SoapTransportException extends SoapException
{
  /**
   * HTTP status code (if available)
   */
  private ?int $httpStatusCode = null;

  /**
   * Connection timeout in seconds
   */
  private ?int $timeout = null;

  /**
   * Number of retry attempts made
   */
  private int $retryCount = 0;

  public function __construct(
    string $message,
    string $service,
    string $soapMethod,
    string $wsdlUrl = '',
    ?int $httpStatusCode = null,
    ?int $timeout = null,
    int $retryCount = 0,
    array $requestData = [],
    array $responseData = [],
    array $context = [],
    ?\Exception $previous = null
  ) {
    $technicalDetails = [
      'http_status_code' => $httpStatusCode,
      'timeout' => $timeout,
      'retry_count' => $retryCount,
    ];

    parent::__construct(
      $message,
      $service,
      $soapMethod,
      $wsdlUrl,
      $requestData,
      $responseData,
      'transport',
      $context,
      $technicalDetails,
      $previous
    );

    $this->httpStatusCode = $httpStatusCode;
    $this->timeout = $timeout;
    $this->retryCount = $retryCount;
  }

  /**
   * Get HTTP status code
   */
  public function getHttpStatusCode(): ?int
  {
    return $this->httpStatusCode;
  }

  /**
   * Get connection timeout
   */
  public function getTimeout(): ?int
  {
    return $this->timeout;
  }

  /**
   * Get retry count
   */
  public function getRetryCount(): int
  {
    return $this->retryCount;
  }

  /**
   * Check if this is a retryable error
   */
  public function isRetryable(): bool
  {
    // Retry on network errors, timeouts, and 5xx HTTP errors
    return $this->httpStatusCode >= 500 ||
      $this->httpStatusCode === null ||
      str_contains(strtolower($this->getMessage()), 'timeout');
  }

  /**
   * Get suggested retry delay in seconds
   */
  public function getRetryDelay(): int
  {
    // Exponential backoff based on retry count
    return min(30, pow(2, $this->retryCount));
  }

  /**
   * Get maximum retry attempts
   */
  public function getMaxRetries(): int
  {
    return 3;
  }

  /**
   * Create from SoapFault
   */
  public static function fromSoapFault(
    \SoapFault $soapFault,
    string $service,
    string $soapMethod,
    string $wsdlUrl = '',
    array $requestData = []
  ): self {
    $httpStatusCode = null;
    $timeout = null;

    // Try to extract HTTP status code from SoapFault
    if (isset($soapFault->faultcode) && str_contains($soapFault->faultcode, 'HTTP')) {
      preg_match('/HTTP (\d+)/', $soapFault->faultcode, $matches);
      $httpStatusCode = isset($matches[1]) ? (int) $matches[1] : null;
    }

    // Check for timeout in message
    if (str_contains(strtolower($soapFault->getMessage()), 'timeout')) {
      $timeout = 30; // Default timeout
    }

    return new self(
      $soapFault->getMessage(),
      $service,
      $soapMethod,
      $wsdlUrl,
      $httpStatusCode,
      $timeout,
      0,
      $requestData,
      [],
      ['fault_code' => $soapFault->faultcode ?? ''],
      $soapFault
    );
  }

  /**
   * Create from cURL error
   */
  public static function fromCurlError(
    string $curlError,
    int $curlErrorCode,
    string $service,
    string $soapMethod,
    string $wsdlUrl = '',
    array $requestData = []
  ): self {
    $message = "cURL error {$curlErrorCode}: {$curlError}";

    $httpStatusCode = null;
    $timeout = null;

    // Map cURL error codes to HTTP status codes
    $curlToHttp = [
      CURLE_OPERATION_TIMEOUTED => 408,
      CURLE_COULDNT_CONNECT => 503,
      CURLE_COULDNT_RESOLVE_HOST => 503,
      CURLE_SSL_CONNECT_ERROR => 503,
    ];

    $httpStatusCode = $curlToHttp[$curlErrorCode] ?? null;

    if ($curlErrorCode === CURLE_OPERATION_TIMEOUTED) {
      $timeout = 30;
    }

    return new self(
      $message,
      $service,
      $soapMethod,
      $wsdlUrl,
      $httpStatusCode,
      $timeout,
      0,
      $requestData,
      [],
      ['curl_error_code' => $curlErrorCode]
    );
  }
}
