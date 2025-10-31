<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Shared;

final class ListIndicatorsOuputDto
{
    /** @param [] $indicators */
    public function __construct(
        public readonly array $indicators
    ) {}
}
