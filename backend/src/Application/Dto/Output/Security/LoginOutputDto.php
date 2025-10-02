<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Security;

use App\Domain\Entity\Session;

final class LoginOutputDto
{
  public function __construct(
    public readonly Session $session
  ) {}
}
