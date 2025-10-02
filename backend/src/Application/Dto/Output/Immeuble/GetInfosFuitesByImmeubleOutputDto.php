<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

use App\Domain\Entity\InfosFuites;

final class GetInfosFuitesByImmeubleOutputDto
{
  public function __construct(
    public readonly InfosFuites $infosFuites
  ) {}
}
