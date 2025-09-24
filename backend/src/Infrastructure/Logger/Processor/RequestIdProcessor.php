<?php

declare(strict_types=1);

namespace App\Infrastructure\Logger\Processor;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Adds request ID to log records for correlation across services
 */
final class RequestIdProcessor implements ProcessorInterface
{
  private const HEADER_NAME = 'X-Request-ID';
  private const ATTRIBUTE_NAME = 'request_id';

  public function __construct(
    private readonly RequestStack $requestStack
  ) {}

  public function __invoke(LogRecord $record): LogRecord
  {
    $request = $this->requestStack->getCurrentRequest();

    if (!$request) {
      return $record;
    }

    // Get or generate request ID
    $requestId = $request->attributes->get(self::ATTRIBUTE_NAME);

    if (!$requestId) {
      $requestId = $request->headers->get(self::HEADER_NAME) ?: $this->generateRequestId();
      $request->attributes->set(self::ATTRIBUTE_NAME, $requestId);
    }

    $record->extra['request_id'] = $requestId;

    return $record;
  }

  private function generateRequestId(): string
  {
    return bin2hex(random_bytes(16));
  }
}
