<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Admin;

final class LoginFromParamOutputDto
{
  public function __construct(
    public readonly Session $session
  ) {}
}
