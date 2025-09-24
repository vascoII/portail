<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Occupant;

final class EditOutputDto
{
  public function __construct(public readonly bool $updated) {}
}
