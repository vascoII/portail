<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosAppareilElect
{
    public function __construct(
        public ?Appareil $appareil = null
    ) {}
}