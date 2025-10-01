<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Shared;

final class GetReportOutputDto
{
  public function __construct(
    public readonly string $reportContent
  ) {}
}
