<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class UserExportParams
{
  public function __construct(
    public readonly bool $exportAll,
    public readonly string $exportFormat
  ) {}
}
