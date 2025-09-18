<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\ReportToken;

final class LoadingOutputDto
{
  public function __construct(public readonly bool $ok) {}
}
