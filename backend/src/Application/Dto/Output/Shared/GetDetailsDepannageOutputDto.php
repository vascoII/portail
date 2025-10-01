<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Shared;

final class GetDetailsDepannageOutputDto
{
  public function __construct(
    public readonly object $detailsDepannage
  ) {}
}
