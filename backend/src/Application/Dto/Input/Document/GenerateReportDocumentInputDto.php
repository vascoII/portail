<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Document;

final class GenerateReportDocumentInputDto
{
    public function __construct(
        public readonly int $id,
        public readonly mixed $content
    ) {}
}
