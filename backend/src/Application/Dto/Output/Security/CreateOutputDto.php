<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Security;

final class CreateOutputDto
{
  public function __construct(public readonly bool $created) {}
}
