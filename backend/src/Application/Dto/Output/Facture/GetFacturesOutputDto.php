<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Facture;

final class GetFacturesOutputDto
{
  public function __construct(
    public readonly Factures $factures
  ) {}
}
