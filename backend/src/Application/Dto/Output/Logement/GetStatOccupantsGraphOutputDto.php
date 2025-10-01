<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class GraphPointDto
{
  public function __construct(
    public readonly string $date,
    public readonly float $value
  ) {}
}

final class GetStatOccupantsGraphOutputDto
{
  public function __construct(
    public readonly array $graphPoints
  ) {}
}
