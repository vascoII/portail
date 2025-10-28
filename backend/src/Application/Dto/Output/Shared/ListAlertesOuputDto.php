<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Shared;

final class ListAlertesOuputDto
{
  public function __construct(
      public readonly array $alertes
  ) {}
}
