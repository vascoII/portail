<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Immeuble;

final class GetInfosImmeublesInputDto
{
    public function __construct(
        public readonly int $pkUser,
        public readonly string $paramsFiltres,
        public readonly string $paramsInfos
    ) {}
}
