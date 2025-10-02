<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Security;

use App\Domain\Entity\Retour;

final class UpdatePasswordOutputDto
{
  public function __construct(
    public readonly Retour $retour
  ) {}
}
