<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class ListAnomaliesInputDto
{
  public function __construct(public readonly string $pkLogement) {}
}
