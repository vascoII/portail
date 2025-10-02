<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosAppareilGaz
{
    public function __construct(
        public ?Appareil $appareil = null
    ) {}
}
