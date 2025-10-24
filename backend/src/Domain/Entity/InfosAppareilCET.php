<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosAppareilCET
{
    public function __construct(
        public ?Appareil $appareil = null,
        public ?Serie $serieConsosDJU = null,
        public ?Serie $serieConsos = null,
        public ?IndexReleve $r6 = null,
        public ?IndexReleve $r5 = null,
        public ?IndexReleve $r4 = null,
        public ?IndexReleve $r3 = null,
        public ?IndexReleve $r2 = null,
        public ?IndexReleve $r1 = null
    ) {}
}
