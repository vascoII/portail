<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Immeuble;

final class InterventionInputDto
{
    public function __construct(
        public readonly string $pkImmeuble
    ) {}
}
