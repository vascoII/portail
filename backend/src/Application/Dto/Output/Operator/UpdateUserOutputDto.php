<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

final class UpdateUserOutputDto
{
  public function __construct(
    public readonly Retour $retour
  ) {}
}
