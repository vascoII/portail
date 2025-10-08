<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource\ResponseProcessor;

use RuntimeException;

class ObjectResponseProcessor implements SoapResponseProcessorInterface
{
    public function __construct(
        private readonly bool $debug = false
    ) {}

    public function supports(string $method): bool
    {
        return !in_array($method, [self::GET_REPORT, self::CREATE_GESTIONNAIRE]);
    }

    public function process(string $method, mixed $response): object
    {
        return $this->processResponse($method, $response);
    }

    /**
    * Process SOAP response and extract result
    */
    private function processResponse(string $method, $response): object|string
    {
        $resultName = $method . 'Result';

        if (!isset($response->{$resultName})) {
        throw new RuntimeException("SOAP method '$method' failed: No result found");
        }

        $result = $response->{$resultName};

        // Check for SOAP errors
        if (isset($result->Erreur) && !empty($result->Erreur)) {
        $errorMessage = $result->Erreur;
        if ($this->debug) {
            $errorMessage .= ' (Debug mode enabled)';
        }
        throw new RuntimeException("SOAP error in method '$method': $errorMessage");
        }

        return $result;
    }
    
}