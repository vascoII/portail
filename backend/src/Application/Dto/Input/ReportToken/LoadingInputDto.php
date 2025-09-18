<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\ReportToken;

final class LoadingInputDto
{
  public function __construct(public readonly string $token) {}
}
