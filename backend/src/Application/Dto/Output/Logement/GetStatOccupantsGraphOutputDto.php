<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

use App\Domain\Entity\GraphPoint;
final class GetStatOccupantsGraphOutputDto
{
  /** @param GraphPoint[] $graphPoints */
  public function __construct(
    public readonly array $graphPoints
  ) {}
}
