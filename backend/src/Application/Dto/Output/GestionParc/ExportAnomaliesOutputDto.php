<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\GestionParc;

final class ExportAnomaliesOutputDto
{
  public function __construct(public readonly bool $generated) {}
}
