<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\GestionParc;

final class DysfunctionsInputDto
{
  public function __construct(public readonly string $pkImmeuble) {}
}
