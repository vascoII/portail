<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateOccupantRepartDocumentInputDto
{
  public function __construct(
    public readonly string $pkImmeuble,
    public readonly string $pkOccupant
  ) {}
}
