<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\GestionParc;

final class ExportInterventionsOutputDto
{
  public function __construct(public readonly bool $generated) {}
}
