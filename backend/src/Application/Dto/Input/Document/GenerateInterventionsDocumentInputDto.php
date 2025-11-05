<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateInterventionsDocumentInputDto
{
    public function __construct(
        public readonly ?int $pkImmeuble = null,
        public readonly ?int $pkLogement = null,
        public readonly ?int $pkOccupant = null,
        public readonly ?string $date1 = null,
        public readonly ?string $date2 = null,
    ) {}
}
