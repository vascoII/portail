<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Admin;

use App\Domain\Entity\Session;
final class LoginFromParamOutputDto
{
  public function __construct(
    public readonly Session $session
  ) {}
}
