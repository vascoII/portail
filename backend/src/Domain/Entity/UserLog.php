<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class UserLog
{
  public function __construct(
    public readonly string $loginId,
    public readonly \DateTime $loginTime
  ) {}
}
