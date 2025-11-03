<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Releve;

final class GenerateReleveInputDto 
{
    // Informations sur l'immeuble
    public string $numeroImmeuble;         // N°
    public ?string $batiment;              // Bâtiment (optionnel)
    public ?string $escalier;              // Escalier (optionnel)
    public ?string $etage;                 // Étage (optionnel)
    public \DateTimeImmutable $datePassage; // Date de passage en relevé
    
    // Informations sur l'occupant
    public string $prenom;
    public string $nom;
    public string $adresse;
    public string $codePostal;
    public string $ville;
    public string $telephone;
    public string $email;

    // Relevés des compteurs
    public ReleveCompteursDto $eauFroide;
    public ReleveCompteursDto $eauChaude;
}