<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Parc;

final class GetParcOutputDto
{
  public function __construct(
    public readonly ?int $pkParc,
    public readonly ?string $nom,
    public readonly ?string $description,
    public readonly ?bool $actif
  ) {}
}
