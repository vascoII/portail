<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Shared;

final class GetDetailsDepannageInpuDto 
{
    public function __construct(
        public readonly string $pkDepannage
    ) {}
}
