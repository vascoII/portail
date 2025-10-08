<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource\ResponseProcessor;

use RuntimeException;

class BoolResponseProcessor implements SoapResponseProcessorInterface
{
    public function supports(string $method): bool
    {
        return $method === self::CREATE_GESTIONNAIRE;
    }

    public function process(string $method, $response): bool
    {
        return $response->CreateGestionnaireResult;
    }

}
