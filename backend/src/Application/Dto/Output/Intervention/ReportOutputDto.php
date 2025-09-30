<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Intervention;

final class ReportOutputDto
{
  public function __construct(
    public readonly string $data,
    public readonly string $filename,
    public readonly int $length    
  ) {}
}
