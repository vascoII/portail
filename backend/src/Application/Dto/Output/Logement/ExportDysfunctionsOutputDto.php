<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class ExportDysfunctionsOutputDto
{
  public function __construct(public readonly bool $exported) {}
}
