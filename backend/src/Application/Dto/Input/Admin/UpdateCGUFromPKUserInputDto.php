<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Admin;

final class UpdateCGUFromPKUserInputDto
{
  public function __construct(
    public readonly int $pkUser,
    public readonly string $cgu
  ) {}
}
