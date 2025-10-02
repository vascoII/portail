<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class ShowRepartReleveInputDto
{
  public function __construct(
    public readonly string $pkImmeuble,
    public readonly string $pkLogement
  ) {}
}
