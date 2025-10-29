<?php

declare(strict_types=1);

namespace App\Infrastructure\Logger\Processor;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

final class SensitiveDataProcessor implements ProcessorInterface
{
    private const MASK_VALUE = '[REDACTED]';
    private const SENSITIVE_KEYS = [
        'password', 'token', 'jwt', 'session_id', 'sessionId', 'pkUser',
        'authorization', 'cookie', 'email', 'phone', 'phoneNumber',
        'client_id', 'clientId', 'user_id', 'userId', 'request_data',
        'input_data', 'output_data', 'config_data', 'wsdl',
        'requestData', 'responseData',
    ];

    public function __invoke(LogRecord $record): LogRecord
    {
        $scrubbedContext = $this->scrubArray($record->context);
        $scrubbedExtra = $this->scrubArray($record->extra);

        return $record->with(context: $scrubbedContext, extra: $scrubbedExtra);
    }

    private function isSensitiveKey(string $key): bool
    {
        $lowerKey = strtolower($key);

        foreach (self::SENSITIVE_KEYS as $sensitiveKey) {
            if (str_contains($lowerKey, strtolower($sensitiveKey))) {
                return true;
            }
        }

        return false;
    }

    private function maskSensitiveValue(string $value): string
    {
        if (strlen($value) <= 6) {
            return self::MASK_VALUE;
        }

        return substr($value, 0, 2) . '...' . substr($value, -2);
    }

    private function scrubArray(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->scrubArray($value);
            } elseif (is_string($value) && $this->isSensitiveKey((string) $key)) {
                $data[$key] = $this->maskSensitiveValue($value);
            }
        }

        return $data;
    }
}
