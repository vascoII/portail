<?php

declare(strict_types=1);

namespace App\Infrastructure\Logger\Processor;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Adds request ID to log records for correlation across services
 * 
 * This processor works in conjunction with RequestIdListener:
 * - RequestIdListener: Generates and sets request ID in request attributes
 * - RequestIdProcessor: Adds request ID to all log records
 */
final class RequestIdProcessor implements ProcessorInterface
{
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

    // Get request ID from request attributes (set by RequestIdListener)
    $requestId = $request->attributes->get(self::ATTRIBUTE_NAME);

    if ($requestId) {
      $record->extra['request_id'] = $requestId;
    }

    return $record;
  }
}
