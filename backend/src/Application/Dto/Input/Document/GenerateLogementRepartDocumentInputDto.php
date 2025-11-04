<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateLogementRepartDocumentInputDto
{
    public function __construct(
        public readonly int $pkImmeuble,
        public readonly int $pkLogement
    ) {}
}
