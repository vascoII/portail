<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Shared;

class SuccessOutputDto
{
  public function __construct(
    public readonly bool $bool
  ) {}
}
