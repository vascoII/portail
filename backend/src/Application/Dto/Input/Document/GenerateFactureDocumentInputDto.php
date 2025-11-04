<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateFactureDocumentInputDto
{
    public function __construct(
        public readonly int $pkFacture
    ) {}
}
