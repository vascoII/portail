<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class GetInfosLogementsInputDto
{
  public function __construct(
    public readonly string $paramsFiltres,
    public readonly string $paramsInfos    
  ) {}
}
