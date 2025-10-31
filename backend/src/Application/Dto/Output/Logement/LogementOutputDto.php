<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class LogementOutputDto
{
    public function __construct(
        public readonly array $logementDto
    ) {}
}
