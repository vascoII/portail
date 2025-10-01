<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Immeuble;

final class GetInfosAnomaliesByImmeubleInputDto
{
  public function __construct(
    public readonly string $pkImmeuble,
    public readonly string $paramsFiltres  
  ) {}
}
