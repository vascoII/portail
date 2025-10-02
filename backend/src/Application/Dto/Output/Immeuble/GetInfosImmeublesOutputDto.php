<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

use App\Domain\Entity\InfosImmeubles;

final class GetInfosImmeublesOutputDto
{
  public function __construct(
    public readonly InfosImmeubles $infosImmeubles
  ) {}
}
