<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\GestionParc;

final class ShowOutputDto
{
  public function __construct(public readonly string $pkImmeuble) {}
}
