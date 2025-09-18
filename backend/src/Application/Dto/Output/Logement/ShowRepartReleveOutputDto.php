<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class ShowRepartReleveOutputDto
{
  public function __construct(public readonly string $pkImmeuble, public readonly string $pkLogement) {}
}
