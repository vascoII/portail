<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Operator;

final class PutOperatorInputDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $email,
        public readonly string $lastname,
        public readonly string $firstname,
        public readonly string $phone,
        public readonly string $job
    ) {}
}
