<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\TableauBordClient;

final class InterventionOutputDto
{
  public function __construct(public readonly array $items) {}
}
