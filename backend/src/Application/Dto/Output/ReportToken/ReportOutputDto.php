<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\ReportToken;

final class ReportOutputDto
{
  public function __construct(public readonly bool $ok) {}
}
