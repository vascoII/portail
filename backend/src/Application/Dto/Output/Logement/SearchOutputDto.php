<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class SearchOutputDto
{
  public function __construct(public readonly array $results) {}
}
