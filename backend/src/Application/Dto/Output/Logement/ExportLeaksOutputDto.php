<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class ExportLeaksOutputDto
{
  public function __construct(public readonly bool $generated) {}
}
