<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Immeuble;

final class GetInfosLogementsByImmeubleInputDto
{
  public function __construct(
    public readonly string $paramsFiltres,
    public readonly string $paramsInfos,
) {}
}

