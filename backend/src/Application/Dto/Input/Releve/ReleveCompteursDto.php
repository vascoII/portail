<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Releve;

final class ReleveCompteursDto
{
    public function __construct(
        public readonly ?string $cuisineNum,
        public readonly ?int $cuisine,
        public readonly ?string $salleDeBainsNum,
        public readonly ?int $salleDeBains,
        public readonly ?string $wcNum,
        public readonly ?int $wc,
        public readonly ?string $autreEmplacementLoc,
        public readonly ?string $autreEmplacementNum,
        public readonly ?int $autreEmplacement
    ) {}
}
