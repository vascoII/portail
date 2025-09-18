<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Immeuble;

final class ListInterventionsInputDto
{
  public function __construct(public readonly string $pkImmeuble) {}
}
