<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

final class EditPasswordOutputDto
{
  public function __construct(public readonly bool $updated) {}
}
