<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class ExportDysfunctionsOutputDto
{
  public function __construct(public readonly bool $generated) {}
}
