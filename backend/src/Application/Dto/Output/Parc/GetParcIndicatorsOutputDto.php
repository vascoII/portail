<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Parc;

final class GetParcIndicatorsOutputDto
{
  public function __construct(
    public readonly ?int $totalInterventions,
    public readonly ?int $totalAnomalies,
    public readonly ?int $totalDysfonctionnements,
    public readonly ?int $totalFuites
  ) {}
}
