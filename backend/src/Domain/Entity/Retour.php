<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Retour
{
  public function __construct(
    public readonly ?string $erreur,
    public readonly ?string $info
  ) {}
}
