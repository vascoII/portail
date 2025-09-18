<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class ShowOutputDto
{
  public function __construct(public readonly string $pkImmeuble) {}
}
