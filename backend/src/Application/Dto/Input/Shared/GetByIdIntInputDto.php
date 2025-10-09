<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Shared;

final class GetByIdIntInputDto
{
  public function __construct(
      public readonly int $id
  ) {}
}
