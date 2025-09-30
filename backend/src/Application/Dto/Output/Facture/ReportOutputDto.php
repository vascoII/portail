<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Facture;

final class ReportOutputDto
{
    public function __construct(
        public readonly string $filename,
        public readonly string $content, // binaire ou base64
        public readonly string $mimeType = 'application/pdf'
    ) {}

}
