<?php

declare(strict_types=1);

namespace App\Domain\Exception\Soap;

use App\Domain\Exception\DomainException;

final class SoapCallFailedException extends DomainException
{
    public static function fromOperation(string $operation, string $message, array $context = []): self
    {   
        return new self(
            message: "SOAP call to '{$operation}' failed: {$message}",
            errorCode: 'SOAP_CALL_FAILED',
            context: array_merge($context, ['operation' => $operation])
        );
    }
}