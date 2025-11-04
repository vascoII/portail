<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateOccupantNoteDocumentInputDto
{
    public function __construct(
        public readonly int $pkOccupant,
        public readonly int $pkImmeuble,
        public readonly ?string $typeEnergie // EAU, CHAUFFAGE ou null
    ) {}
}
