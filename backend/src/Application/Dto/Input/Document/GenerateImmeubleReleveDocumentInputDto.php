<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateImmeubleReleveDocumentInputDto
{
  public function __construct(
    public readonly string $pkReleve
  ) {}
}
