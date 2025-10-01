<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

final class CreateGestionnaireOutputDto
{
  public function __construct(
    public readonly bool $success
  ) {}
}
