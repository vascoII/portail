<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class GetInfosDysfonctionnementsByImmeubleOutputDto
{
  public function __construct(
    public readonly InfosDysfonctionnements $infosDysfonctionnements
  ) {}
}
