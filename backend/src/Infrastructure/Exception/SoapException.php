<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

/**
 * Base exception for SOAP-related errors.
 */
abstract class SoapException extends InfrastructureException
{
    /**
     * SOAP request data (sanitized).
     */
    protected array $requestData = [];

    /**
     * SOAP response data (sanitized).
     */
    protected array $responseData = [];

    /**
     * The SOAP method that was called.
     */
    protected string $soapMethod = '';

    /**
     * The WSDL URL.
     */
    protected string $wsdlUrl = '';

    public function __construct(
        string $message,
        string $service,
        string $soapMethod,
        string $wsdlUrl = '',
        array $requestData = [],
        array $responseData = [],
        string $operation = '',
        array $context = [],
        array $technicalDetails = [],
        ?\Exception $previous = null
    ) {
        // Add SOAP-specific context
        $context['soap_method'] = $soapMethod;
        if ($wsdlUrl) {
            $context['wsdl_url'] = $wsdlUrl;
        }
        $context['request_data'] = $this->sanitizeData($requestData);
        $context['response_data'] = $this->sanitizeData($responseData);

        parent::__construct(
            $message,
            $service,
            $operation,
            'SOAP_ERROR',
            $context,
            $technicalDetails,
            $previous
        );

        $this->soapMethod = $soapMethod;
        $this->wsdlUrl = $wsdlUrl;
        $this->requestData = $this->sanitizeData($requestData);
        $this->responseData = $this->sanitizeData($responseData);
    }

    /**
     * Get sanitized request data.
     */
    public function getRequestData(): array
    {
        return $this->requestData;
    }

    /**
     * Get sanitized response data.
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }

    /**
     * Get the SOAP method that was called.
     */
    public function getSoapMethod(): string
    {
        return $this->soapMethod;
    }

    /**
     * Get the WSDL URL.
     */
    public function getWsdlUrl(): string
    {
        return $this->wsdlUrl;
    }

    /**
     * Recursively sanitize array data.
     */
    private function recursiveSanitize(array $data, array $sensitiveKeys): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->recursiveSanitize($value, $sensitiveKeys);
            } elseif (in_array($key, $sensitiveKeys, true)) {
                $data[$key] = '[REDACTED]';
            }
        }

        return $data;
    }

    /**
     * Sanitize data by removing sensitive information.
     */
    private function sanitizeData(array $data): array
    {
        $sensitiveKeys = ['password', 'token', 'sessionId', 'pkUser', 'SessionID', 'PkUser'];

        return $this->recursiveSanitize($data, $sensitiveKeys);
    }
}
