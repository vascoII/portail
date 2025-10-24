<?php

declare(strict_types=1);

namespace App\Infrastructure\Logger\Processor;

use App\Http\Exception\HttpException;
use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

/**
 * Adds exception context to log records when exceptions are logged.
 *
 * This processor enriches log records with structured exception information
 * from the new exception hierarchy.
 */
final class ExceptionContextProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record): LogRecord
    {
        // Check if this is an exception log record
        if (! isset($record->context['exception_class'])) {
            return $record;
        }

        $exceptionClass = $record->context['exception_class'];

        // Add structured exception context for our custom exceptions
        if (is_subclass_of($exceptionClass, HttpException::class)) {
            $record->extra['exception_type'] = 'http_exception';
            $record->extra['http_status_code'] = $record->context['http_status_code'] ?? null;
            $record->extra['error_code'] = $record->context['error_code'] ?? null;
            $record->extra['component'] = $record->context['component'] ?? null;
            $record->extra['operation'] = $record->context['operation'] ?? null;
        } elseif (str_starts_with($exceptionClass, 'App\Domain\Exception\\')) {
            $record->extra['exception_type'] = 'domain_exception';
            $record->extra['error_code'] = $record->context['error_code'] ?? null;
        } elseif (str_starts_with($exceptionClass, 'App\Infrastructure\Exception\\')) {
            $record->extra['exception_type'] = 'infrastructure_exception';
            $record->extra['error_code'] = $record->context['error_code'] ?? null;
            $record->extra['service'] = $record->context['service'] ?? null;
            $record->extra['operation'] = $record->context['operation'] ?? null;
            $record->extra['is_retryable'] = $record->context['is_retryable'] ?? null;
        } elseif (str_starts_with($exceptionClass, 'App\Application\Exception\\')) {
            $record->extra['exception_type'] = 'application_exception';
            $record->extra['error_code'] = $record->context['error_code'] ?? null;
            $record->extra['component'] = $record->context['component'] ?? null;
            $record->extra['operation'] = $record->context['operation'] ?? null;
        } else {
            $record->extra['exception_type'] = 'generic_exception';
        }

        // Add log level from exception if available
        if (isset($record->context['log_level'])) {
            $record->extra['exception_log_level'] = $record->context['log_level'];
        }

        // Add retry information for infrastructure exceptions
        if (isset($record->context['is_retryable']) && $record->context['is_retryable']) {
            $record->extra['retry_info'] = [
                'is_retryable' => true,
                'retry_delay' => $record->context['retry_delay'] ?? 0,
                'max_retries' => $record->context['max_retries'] ?? 0,
            ];
        }

        return $record;
    }
}
