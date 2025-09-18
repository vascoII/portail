<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Front;

final class CguOutputDto
{
  public function __construct(public readonly string $message) {}
}
