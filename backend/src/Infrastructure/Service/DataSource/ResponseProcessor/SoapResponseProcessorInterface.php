<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource\ResponseProcessor;

interface SoapResponseProcessorInterface
{
    public const GET_REPORT = "GetReport";

    public function supports(string $method): bool;

    public function process(string $method, mixed $response): mixed;
}
