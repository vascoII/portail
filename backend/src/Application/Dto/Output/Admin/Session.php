<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Admin;

final class Session
{
  public function __construct(
    public readonly bool $connected,
    public readonly string $sessionId,
    public readonly User $user
  ) {}
}
