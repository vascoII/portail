<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\External;

final class GetReportByTokenOutputDto
{
  
  public function __construct(
      public readonly mixed $content,
      public readonly string $mimeType,
      public readonly string $filename,
      public readonly string $length
  ) {}
}
