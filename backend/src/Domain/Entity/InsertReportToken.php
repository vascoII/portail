<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InsertReportToken
{
  public function __construct(
    public readonly ?string $sessionId,
    public readonly ?string $reportType,
    public readonly ?string $param
  ) {}
}
