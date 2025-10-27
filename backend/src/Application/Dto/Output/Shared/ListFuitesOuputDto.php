<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Shared;

use App\Domain\Entity\Immeuble;

final class ListFuitesOuputDto
{

  public function __construct(
      public readonly array $fuites
  ) {}
}
