<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosAnomalie
{
    public function __construct(
        public readonly ?Logement $logement,
        public readonly ?Occupant $occupant,
        public readonly ?Appareil $appareil,
        public readonly ?Anomalie $anomalie
    ) {}
}
