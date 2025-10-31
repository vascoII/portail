<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Document;

final class GetReportExcelDataSourceOutputDto
{
    public function __construct(
        public readonly ?string $excelContent
    ) {}
}
