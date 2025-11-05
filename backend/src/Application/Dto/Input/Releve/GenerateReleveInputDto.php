<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Releve;

final class GenerateReleveInputDto
{
    public function __construct(
        public readonly string $numeroImmeuble,
        public readonly \DateTimeImmutable $datePassage,
        public readonly string $prenom,
        public readonly string $nom,
        public readonly string $adresse,
        public readonly string $codePostal,
        public readonly string $ville,
        public readonly string $telephone,
        public readonly string $email,

        public readonly ?string $batiment,
        public readonly ?string $escalier,
        public readonly ?string $etage,
        
        public readonly ReleveCompteursDto $eauChaude,
        public readonly ReleveCompteursDto $eauFroide,
    ) {}
}
