<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Front;

final class PersonalDatasOutputDto
{
  public function __construct(public readonly string $message) {}
}
