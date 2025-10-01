<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class GetInfosAnomaliesByImmeubleOutputDto
{
  public function __construct(
    public readonly InfosAnomalies $infosAnomalies
  ) {}
}
