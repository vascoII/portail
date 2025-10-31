<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Shared;

final class ListAnomaliesOuputDto
{
    public function __construct(
        public readonly array $anomalies
    ) {}
}
