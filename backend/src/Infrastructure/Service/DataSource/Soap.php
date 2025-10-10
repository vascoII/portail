<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Infrastructure\Service\DataSource\SoapClient;
use App\Domain\Exception\DomainExceptionFactory;

class Soap
{
    public function __construct(
      public readonly SoapClient $soapClient,
    ) {}

    public function safeCall(string $operation, object $request): mixed
    {
        try {
            return $this->soapClient->call($operation, $request);
        } catch (\Throwable $e) {
            throw DomainExceptionFactory::soapCallFailed($operation, $e->getMessage(), [
                'request' => $request,
                'exception' => $e,
            ]);
        }
    }

}
