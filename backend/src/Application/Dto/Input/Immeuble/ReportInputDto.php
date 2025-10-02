<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Immeuble;

final class ReportInputDto
{
  public function __construct(
    public readonly string $pkImmeuble,
    public readonly string $type,
    public readonly string $energie
  ) {}
}

