<?php

declare(strict_types=1);

namespace App\Infrastructure\Logger\Processor;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

/**
 * Scrubs sensitive data from log records
 */
final class SensitiveDataProcessor implements ProcessorInterface
{
  private const SENSITIVE_KEYS = [
    'password',
    'token',
    'jwt',
    'session_id',
    'sessionId',
    'pkUser',
    'authorization',
    'cookie',
    'email',
    'phone',
    'phoneNumber',
    'client_id',
    'clientId',
    'user_id',
    'userId',
    'request_data',
    'input_data',
    'output_data',
    'config_data',
    'wsdl',
    'requestData',
    'responseData'
  ];

  private const MASK_VALUE = '[REDACTED]';

  public function __invoke(LogRecord $record): LogRecord
  {
    $record->context = $this->scrubArray($record->context);
    $record->extra = $this->scrubArray($record->extra);

    return $record;
  }

  private function scrubArray(array $data): array
  {
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $data[$key] = $this->scrubArray($value);
      } elseif (is_string($value) && $this->isSensitiveKey($key)) {
        $data[$key] = $this->maskSensitiveValue($value);
      }
    }

    return $data;
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

    // For longer values, show first 2 and last 2 characters
    return substr($value, 0, 2) . '...' . substr($value, -2);
  }
}
