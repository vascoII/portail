<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Operator;

final class PatchOperatorInputDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $password
    ) {}
}
