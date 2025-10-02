<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosAppareilEAU
{
    public function __construct(
        public ?Appareil $appareil = null,
        public ?Serie $serieConsos = null,
        public ?IndexReleve $r6 = null,
        public ?IndexReleve $r5 = null,
        public ?IndexReleve $r4 = null,
        public ?IndexReleve $r3 = null,
        public ?IndexReleve $r2 = null,
        public ?IndexReleve $r1 = null,
        public ?int $nbFuites = null,
        public ?int $nbDepannages = null,
        public ?int $nbDysfonctionnements = null,
        public ?int $nbAnomalies = null
    ) {}
}