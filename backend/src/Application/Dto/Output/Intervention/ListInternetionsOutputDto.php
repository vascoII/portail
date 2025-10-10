<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Intervention;

use App\Domain\Entity\Immeuble;

final class ListInternetionsOutputDto
{
  /** @param Immeuble[] $immeubleDto */
  public function __construct(
    public readonly array $immeubleDto
  ) {}
}