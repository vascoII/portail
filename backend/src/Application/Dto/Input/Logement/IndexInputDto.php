<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class IndexInputDto
{
  public function __construct(public readonly string $pkImmeuble) {}
}
