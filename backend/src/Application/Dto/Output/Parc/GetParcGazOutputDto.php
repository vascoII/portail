<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Parc;

final class GetParcGazOutputDto
{
  public function __construct(
    public readonly ?float $consommation,
    public readonly ?string $unite,
    public readonly ?\DateTimeImmutable $dateDebut,
    public readonly ?\DateTimeImmutable $dateFin
  ) {}
}
