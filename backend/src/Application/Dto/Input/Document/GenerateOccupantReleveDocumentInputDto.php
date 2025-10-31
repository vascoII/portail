<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateOccupantReleveDocumentInputDto
{
    public function __construct(
        public readonly string $pkOccupant
    ) {}
}
