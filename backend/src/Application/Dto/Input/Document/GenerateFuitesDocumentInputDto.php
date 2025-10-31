<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateFuitesDocumentInputDto
{
    public function __construct(
        public readonly string $pkImmeuble,
        public readonly ?string $pkLogement = null,
        public readonly ?string $pkOccupant = null,
        public readonly ?string $pkAppareil = null
    ) {}
}
