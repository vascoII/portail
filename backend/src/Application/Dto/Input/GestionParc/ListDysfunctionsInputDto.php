<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\GestionParc;

final class ListDysfunctionsInputDto
{
  public function __construct(public readonly string $pkImmeuble) {}
}
