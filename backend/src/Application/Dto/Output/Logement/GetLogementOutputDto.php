<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

use App\Domain\Entity\Logement;

final class GetLogementOutputDto
{
  public function __construct(
    public readonly Logement $logement
  ) {}
}
