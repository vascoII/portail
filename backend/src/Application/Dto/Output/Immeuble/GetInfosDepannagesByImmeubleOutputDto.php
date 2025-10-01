<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class GetInfosDepannagesByImmeubleOutputDto
{
  public function __construct(
    public readonly InfosDepannages $infosDepannages
  ) {}
}
