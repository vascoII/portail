<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

use App\Domain\Entity\Immeuble;

final class ListImmeublesOutputDto
{
    /** @param Immeuble[] $immeubles */
    public function __construct(
        public readonly array $immeubles
    ) {}
}
