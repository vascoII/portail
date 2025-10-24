<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource\ResponseProcessor;

interface SoapResponseProcessorInterface
{
    public const CREATE_GESTIONNAIRE = 'CreateGestionnaire';
    public const GET_REPORT = 'GetReport';

    public function process(string $method, mixed $response): mixed;

    public function supports(string $method): bool;
}
