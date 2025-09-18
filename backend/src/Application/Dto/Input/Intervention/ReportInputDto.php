<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Intervention;

final class ReportInputDto
{
  public function __construct(public readonly string $pkDepannage) {}
}
