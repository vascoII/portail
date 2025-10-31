<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Shared;

final class GetExcelInpuDto
{
    public function __construct(
        public readonly string $type,
        public readonly string $params
    ) {}
}
