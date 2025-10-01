<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class GetNbTicketsInterByLogementOutputDto
{
  public function __construct(
    public readonly int $nbTickets
  ) {}
}
