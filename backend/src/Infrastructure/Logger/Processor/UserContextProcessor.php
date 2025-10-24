<?php

declare(strict_types=1);

namespace App\Infrastructure\Logger\Processor;

use App\Application\Service\Auth\AuthServiceInterface;
use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

/**
 * Adds user context to log records when available.
 */
final class UserContextProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly AuthServiceInterface $authService
    ) {}

    public function __invoke(LogRecord $record): LogRecord
    {
        $user = $this->authService->getCurrentUser();

        if ($user) {
            $record->extra['user_id'] = $user->pkUser;
            $record->extra['user_name'] = $user->userName;
            $record->extra['client_id'] = $user->clientId;
        }

        return $record;
    }
}
