<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Releve;

final class GenerateReleveInputDto
{
    public string $adresse;

    public ?string $batiment;              // Bâtiment (optionnel)

    public string $codePostal;

    public \DateTimeImmutable $datePassage; // Date de passage en relevé

    public ReleveCompteursDto $eauChaude;

    // Relevés des compteurs
    public ReleveCompteursDto $eauFroide;

    public string $email;

    public ?string $escalier;              // Escalier (optionnel)

    public ?string $etage;                 // Étage (optionnel)

    public string $nom;

    // Informations sur l'immeuble
    public string $numeroImmeuble;         // N°

    // Informations sur l'occupant
    public string $prenom;

    public string $telephone;

    public string $ville;
}
