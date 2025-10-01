<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Appareil
{
  public function __construct(
    public readonly ?int $pkAppareil,
    public readonly ?string $numero,
    public readonly ?string $emplacement,
    public readonly ?string $fluide,
    public readonly ?string $typeAppareil,
    public readonly ?string $unite
  ) {}
}
