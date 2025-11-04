<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateOccupantRepartDocumentInputDto
{
    public function __construct(
        public readonly int $pkImmeuble,
        public readonly int $pkOccupant
    ) {}
}
