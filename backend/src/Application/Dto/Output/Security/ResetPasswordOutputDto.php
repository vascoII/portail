<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Security;

final class ResetPasswordOutputDto
{
  public function __construct(public readonly bool $success) {}
}
