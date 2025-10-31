<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateImmeubleDetailDocumentInputDto
{
    public function __construct(
        public readonly string $date1,
        public readonly string $date2
    ) {}
}
