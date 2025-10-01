<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class GetNbTicketsInterByLogementInputDto 
{
    public function __construct(
    public readonly int $pkLogement,
    public readonly string $paramsFilters
  ) {}
}
