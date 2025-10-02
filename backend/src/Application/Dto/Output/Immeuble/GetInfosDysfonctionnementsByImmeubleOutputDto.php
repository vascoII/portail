<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

use App\Domain\Entity\InfosDysfonctionnements;

final class GetInfosDysfonctionnementsByImmeubleOutputDto
{
  public function __construct(
    public readonly InfosDysfonctionnements $infosDysfonctionnements
  ) {}
}
