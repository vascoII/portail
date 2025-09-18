<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class GetTicketOnwerInputDto
{
  public function __construct(public readonly string $pkImmeuble) {}
}
