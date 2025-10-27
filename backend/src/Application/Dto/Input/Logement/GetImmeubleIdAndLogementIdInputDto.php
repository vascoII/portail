<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class GetImmeubleIdAndLogementIdInputDto
{
  public function __construct(
    public readonly int $pkImmeuble,
    public readonly int $pkLogement
  ) {}
}
