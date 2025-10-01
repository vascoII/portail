<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class GetInfosLogementsByImmeubleOutputDto
{
  public function __construct(
    public readonly InfosLogements $infosLogements
  ) {}
}
