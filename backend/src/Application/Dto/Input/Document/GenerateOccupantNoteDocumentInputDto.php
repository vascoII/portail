<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateOccupantNoteDocumentInputDto
{
  public function __construct(
    public readonly string $pkOccupant,
    public readonly string $pkImmeuble,
    public readonly ?string $typeEnergie // EAU, CHAUFFAGE ou null
  ) {}
}
