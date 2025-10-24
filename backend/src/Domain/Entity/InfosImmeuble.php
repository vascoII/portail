<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosImmeuble
{
    public function __construct(
        public readonly ?Immeuble $immeuble,
        public readonly ?int $nbLogements,
        public readonly ?int $nbAppareils,
        public readonly ?int $nbCompteursEc,
        public readonly ?int $nbCompteursEf,
        public readonly ?int $nbCompteursRepart,
        public readonly ?int $nbCompteursCet,
        public readonly ?int $nbCompteursCapteur,
        public readonly ?int $nbCompteursElect,
        public readonly ?int $nbCompteursGaz,
        public readonly ?int $nbFuites,
        public readonly ?int $nbDepannages,
        public readonly ?int $nbDysfonctionnements,
        public readonly ?int $nbAnomalies,
        public readonly ?int $nbChantiers
    ) {}
}
