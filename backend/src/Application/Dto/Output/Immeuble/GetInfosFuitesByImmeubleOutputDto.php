<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class GetInfosFuitesByImmeubleOutputDto
{
  public function __construct(
    public readonly InfosFuites $infosFuites
  ) {}
}
