<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

use App\Domain\Entity\InfosLogement;
final class GetInfosLogementsOutputDto
{
  /** @param InfosLogement[] $infosLogements */
  public function __construct(
    public readonly array $infosLogements
  ) {}
}
