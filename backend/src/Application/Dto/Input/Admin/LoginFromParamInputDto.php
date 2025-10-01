<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Admin;

final class LoginFromParamInputDto
{
  public function __construct(
    public readonly string $param
  ) {}
}
