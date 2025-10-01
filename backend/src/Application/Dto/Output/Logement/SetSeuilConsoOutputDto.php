<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class SetSeuilConsoOutputDto
{
  public function __construct(
    public readonly string $error,
    public readonly string $info
  ) {}
}
