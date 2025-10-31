<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Intervention;

final class ListCasesOutputDto
{
    public function __construct(
        public readonly bool $success
    ) {}
}
