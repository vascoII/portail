<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Front;

final class IndexOutputDto
{
  public function __construct(public readonly string $page) {}
}
