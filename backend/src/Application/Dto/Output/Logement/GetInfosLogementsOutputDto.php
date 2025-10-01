<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class GetInfosLogementsOutputDto
{
  public function __construct(
    public readonly object $infosLogements
  ) {}
}
