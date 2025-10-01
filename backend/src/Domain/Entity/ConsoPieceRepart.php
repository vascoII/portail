<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class ConsoPieceRepart
{
  public function __construct(
    public readonly ?string $emplacement,
    public readonly ?IndexReleve $r1,
    public readonly ?IndexReleve $r2
  ) {}
}
