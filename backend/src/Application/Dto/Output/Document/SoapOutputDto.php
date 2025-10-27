<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Document;

final class SoapOutputDto
{
  public function __construct(
    public readonly int $id
  ) {}
}
