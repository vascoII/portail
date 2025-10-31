<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Intervention;

final class GetCasesByEmailInpuDto
{
    public function __construct(
        public readonly string $id,
        public readonly string $email,
    ) {}
}
