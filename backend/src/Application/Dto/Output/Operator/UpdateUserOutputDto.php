<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Operator;

use App\Domain\Entity\Retour;

final class UpdateUserOutputDto
{
  public function __construct(
    public readonly Retour $retour
  ) {}
}
