<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource\ResponseProcessor;

class BoolResponseProcessor implements SoapResponseProcessorInterface
{
    public function process(string $method, $response): bool
    {
        return $response->CreateGestionnaireResult;
    }

    public function supports(string $method): bool
    {
        return self::CREATE_GESTIONNAIRE === $method;
    }
}
