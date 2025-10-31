<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Shared;

final class GetExcelOutputDto
{
    public function __construct(
        public readonly string $excelContent
    ) {}
}
