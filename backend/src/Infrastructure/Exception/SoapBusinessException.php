<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

use App\Domain\Exception\BusinessRuleException;

/**
 * Exception for SOAP business logic errors
 * 
 * This exception represents business logic failures returned by SOAP services,
 * such as validation errors, business rule violations, or application-specific errors.
 */
final class SoapBusinessException extends SoapException
{
  /**
   * SOAP fault code
   */
  private string $faultCode = '';

  /**
   * SOAP fault string
   */
  private string $faultString = '';

  /**
   * SOAP fault actor
   */
  private ?string $faultActor = null;

  /**
   * SOAP fault detail
   */
  private ?string $faultDetail = null;

  public function __construct(
    string $message,
    string $service,
    string $soapMethod,
    string $faultCode,
    string $faultString,
    string $wsdlUrl = '',
    ?string $faultActor = null,
    ?string $faultDetail = null,
    array $requestData = [],
    array $responseData = [],
    array $context = [],
    ?\Exception $previous = null
  ) {
    $technicalDetails = [
      'fault_code' => $faultCode,
      'fault_string' => $faultString,
      'fault_actor' => $faultActor,
      'fault_detail' => $faultDetail,
    ];

    parent::__construct(
      $message,
      $service,
      $soapMethod,
      $wsdlUrl,
      $requestData,
      $responseData,
      'business',
      $context,
      $technicalDetails,
      $previous
    );

    $this->faultCode = $faultCode;
    $this->faultString = $faultString;
    $this->faultActor = $faultActor;
    $this->faultDetail = $faultDetail;
  }

  /**
   * Get SOAP fault code
   */
  public function getFaultCode(): string
  {
    return $this->faultCode;
  }

  /**
   * Get SOAP fault string
   */
  public function getFaultString(): string
  {
    return $this->faultString;
  }

  /**
   * Get SOAP fault actor
   */
  public function getFaultActor(): ?string
  {
    return $this->faultActor;
  }

  /**
   * Get SOAP fault detail
   */
  public function getFaultDetail(): ?string
  {
    return $this->faultDetail;
  }

  /**
   * Check if this is a retryable error
   */
  public function isRetryable(): bool
  {
    // Business logic errors are generally not retryable
    return false;
  }

  /**
   * Get suggested retry delay in seconds
   */
  public function getRetryDelay(): int
  {
    return 0;
  }

  /**
   * Get maximum retry attempts
   */
  public function getMaxRetries(): int
  {
    return 0;
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
    return new self(
      $soapFault->getMessage(),
      $service,
      $soapMethod,
      $soapFault->faultcode ?? 'Unknown',
      $soapFault->faultstring ?? 'Unknown fault',
      $wsdlUrl,
      $soapFault->faultactor ?? null,
      $soapFault->detail ?? null,
      $requestData,
      [],
      [],
      $soapFault
    );
  }

  /**
   * Create from SOAP response with error
   */
  public static function fromSoapResponse(
    array $soapResponse,
    string $service,
    string $soapMethod,
    string $wsdlUrl = '',
    array $requestData = []
  ): self {
    $error = $soapResponse['Erreur'] ?? 'Unknown error';
    $info = $soapResponse['Info'] ?? '';

    $message = $error;
    if ($info) {
      $message .= " - {$info}";
    }

    return new self(
      $message,
      $service,
      $soapMethod,
      'SOAP_BUSINESS_ERROR',
      $error,
      $wsdlUrl,
      null,
      $info,
      $requestData,
      $soapResponse
    );
  }

  /**
   * Convert to Domain BusinessRuleException
   */
  public function toBusinessRuleException(): BusinessRuleException
  {
    return new BusinessRuleException(
      $this->getMessage(),
      'SOAP_BUSINESS_ERROR',
      $this->getService(),
      null,
      [
        'soap_method' => $this->getSoapMethod(),
        'fault_code' => $this->faultCode,
        'fault_string' => $this->faultString,
      ],
      $this
    );
  }
}
