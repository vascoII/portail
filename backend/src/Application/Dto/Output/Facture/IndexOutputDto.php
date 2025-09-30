<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Facture;

final class IndexOutputDto
{
  /** @param ListFactureOutputDto $listFactures */
  public function __construct(
      public readonly ListFactureOutputDto $listFactures
  ) {}
}
