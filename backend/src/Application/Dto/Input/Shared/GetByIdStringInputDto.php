<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Shared;

final class GetByIdStringInputDto
{
  public function __construct(
      public readonly string $id
  ) {}
}
