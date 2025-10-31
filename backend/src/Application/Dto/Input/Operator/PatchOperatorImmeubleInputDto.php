<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Operator;

final class PatchOperatorImmeubleInputDto
{
    public function __construct(
        public readonly int $operatorId,
        public readonly int $immeubleId
    ) {}
}
