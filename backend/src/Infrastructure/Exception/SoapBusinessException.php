<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

use App\Domain\Exception\BusinessRuleException;

/**
 * Exception for SOAP business logic errors.
 *
 * This exception represents business logic failures returned by SOAP services,
 * such as validation errors, business rule violations, or application-specific errors.
 */
final class SoapBusinessException extends SoapException
{
    /**
     * SOAP fault actor.
     */
    private ?string $faultActor = null;

    /**
     * SOAP fault code.
     */
    private string $faultCode = '';

    /**
     * SOAP fault detail.
     */
    private ?string $faultDetail = null;

    /**
     * SOAP fault string.
     */
    private string $faultString = '';

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
     * Create from SoapFault.
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
     * Create from SOAP response with error.
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
     * Get SOAP fault actor.
     */
    public function getFaultActor(): ?string
    {
        return $this->faultActor;
    }

    /**
     * Get SOAP fault code.
     */
    public function getFaultCode(): string
    {
        return $this->faultCode;
    }

    /**
     * Get SOAP fault detail.
     */
    public function getFaultDetail(): ?string
    {
        return $this->faultDetail;
    }

    /**
     * Get SOAP fault string.
     */
    public function getFaultString(): string
    {
        return $this->faultString;
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
     * Check if this is a retryable error.
     */
    public function isRetryable(): bool
    {
        // Business logic errors are generally not retryable
        return false;
    }

    /**
     * Convert to Domain BusinessRuleException.
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
