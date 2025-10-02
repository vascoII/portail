<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosAppareilsEAU
{
    public function __construct(
        public ?array $listeInfosAppareils = null, // InfosAppareilEAU[]
        public ?\DateTime $dateR6 = null,
        public ?\DateTime $dateR5 = null,
        public ?\DateTime $dateR4 = null,
        public ?\DateTime $dateR3 = null,
        public ?\DateTime $dateR2 = null,
        public ?\DateTime $dateR1 = null
    ) {}
}
