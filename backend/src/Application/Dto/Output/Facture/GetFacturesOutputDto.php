<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Facture;

use App\Domain\Entity\Facture;
final class GetFacturesOutputDto
{
  /** @param Facture[] $factures */
  public function __construct(
    public readonly array $factures
  ) {}
}
