<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class GetTableauBordImmeubleOutputDto
{
  public function __construct(
    public readonly object $immeuble,
    public readonly array $logements,
    public readonly int $nbAppareils,
    public readonly int $nbDepannages,
    public readonly int $nbDysfonctionnements,
    public readonly int $nbAnomalies,
    public readonly int $nbFuites
  ) {}
}
