<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Occupant;

final class MyAccountOutputDto
{
  public function __construct(public readonly array $account) {}
}
