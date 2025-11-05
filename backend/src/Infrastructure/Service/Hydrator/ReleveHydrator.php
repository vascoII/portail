<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Releve\GenerateReleveInputDto;

final class ReleveHydrator extends Hydrator
{
    public function hydratePostReleve(GenerateReleveInputDto $inputDto): object
    {
        return (object) [
            'SuperLoginID' => $this->superLoginID,
			'SuperPassword' => $this->superPassword,
			'immeuble' => $inputDto->numeroImmeuble,
			'batiment' => $inputDto->batiment,
			'escalier' => $inputDto->escalier,
			'etage' => $inputDto->etage,
			'date_passage' => $inputDto->datePassage->format('d/m/Y'),
			'prenom' => $inputDto->prenom,
			'nom' => $inputDto->nom,
			'adresse' => $inputDto->adresse,
			'code_postal' => $inputDto->codePostal,
			'ville' => $inputDto->ville,
			'telephone' => $inputDto->telephone,
			'email' => $inputDto->email,
			'ef_cuisine' => 'Numéro de compteur : '. $inputDto->eauFroide->cuisineNum .' - Index : '. $inputDto->eauFroide->cuisine,
			'ef_salle_de_bains' => 'Numéro de compteur : '. $inputDto->eauFroide->salleDeBainsNum .' - Index : '. $inputDto->eauFroide->salleDeBains,
			'ef_wc' => 'Numéro de compteur : '. $inputDto->eauFroide->wcNum .' - Index : '. $inputDto->eauFroide->wc,
			'ef_autre' => 'Numéro de compteur : '. $inputDto->eauFroide->autreEmplacementNum .' - Index : '. $inputDto->eauFroide->autreEmplacement,
			'ef_nomautre' => $inputDto->eauFroide->autreEmplacementLoc,
			'ec_cuisine' => 'Numéro de compteur : '. $inputDto->eauChaude->cuisineNum .' - Index : '. $inputDto->eauChaude->cuisine,
			'ec_salle_de_bains' => 'Numéro de compteur : '. $inputDto->eauChaude->salleDeBainsNum .' - Index : '. $inputDto->eauChaude->salleDeBains,
			'ec_wc' => 'Numéro de compteur : '. $inputDto->eauChaude->wcNum .' - Index : '. $inputDto->eauChaude->wc,
			'ec_autre' => 'Numéro de compteur : '. $inputDto->eauChaude->autreEmplacementNum .' - Index : '. $inputDto->eauChaude->autreEmplacement,
			'ec_nomautre' => $inputDto->eauChaude->autreEmplacementLoc
        ];
    }
}