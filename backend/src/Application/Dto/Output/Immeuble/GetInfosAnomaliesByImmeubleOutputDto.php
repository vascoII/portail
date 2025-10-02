<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

use App\Domain\Entity\InfosAnomalies;
final class GetInfosAnomaliesByImmeubleOutputDto
{
  public function __construct(
    public readonly InfosAnomalies $infosAnomalies
  ) {}
}
