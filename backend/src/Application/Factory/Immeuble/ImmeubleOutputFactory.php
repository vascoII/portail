<?php

declare(strict_types=1);

namespace App\Application\Factory\Immeuble;

use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Dto\Output\Immeuble\ListInterventionsOutputDto ;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Domain\Entity\Immeuble;
use App\Domain\Entity\Depannage;

final class ImmeubleOutputFactory 
{
    /**
     * @param User[] $immeubles
     */
    public function createListImmeubles(array $immeubles): ListImmeublesOutputDto
    {
        return new ListImmeublesOutputDto($immeubles);
    }

    /**
     * @param User $immeuble
     */
    public function createGetImmeuble(Immeuble $immeuble): GetImmeubleOutputDto
    {
        return new GetImmeubleOutputDto(
            pkImmeuble: $immeuble->pkImmeuble,
            nom: $immeuble->nom,
            numero: $immeuble->numero,
            ref: $immeuble->ref,
            adresse1: $immeuble->adresse1,
            adresse2: $immeuble->adresse2,
            adresse3: $immeuble->adresse3,
            cp: $immeuble->cp,
            ville: $immeuble->ville,
            hasTelereleve: $immeuble->hasTelereleve,
            fkClientTop: $immeuble->fkClientTop,
            actif: $immeuble->actif,
            dateActivationClient: $immeuble->dateActivationClient,
            dateActivationOccupant: $immeuble->dateActivationOccupant,
            hasNoteOccupant: $immeuble->hasNoteOccupant,
            hasDecompteOccupant: $immeuble->hasDecompteOccupant,
            hasFactures: $immeuble->hasFactures,
            hasChantiers: $immeuble->hasChantiers,
            nbLogements: $immeuble->nbLogements,
            nbAppareils: $immeuble->nbAppareils,
            nbDepannages: $immeuble->nbDepannages,
            nbDepannagesTotal: $immeuble->nbDepannagesTotal,
            degresDepannages: $immeuble->degresDepannages,
            nbDysfonctionnements: $immeuble->nbDysfonctionnements,
            degresDysfonctionnements: $immeuble->degresDysfonctionnements,
            nbCompteursEC: $immeuble->nbCompteursEC,
            nbCompteursEF: $immeuble->nbCompteursEF,
            nbCompteursRepart: $immeuble->nbCompteursRepart,
            nbCompteursCET: $immeuble->nbCompteursCET,
            nbCompteursCapteur: $immeuble->nbCompteursCapteur,
            nbCompteursElect: $immeuble->nbCompteursElect,
            nbCompteursGaz: $immeuble->nbCompteursGaz,
            nbCompteursTelereveleTotal: $immeuble->nbCompteursTelereveleTotal,
            nbCompteursTelereveleOK: $immeuble->nbCompteursTelereveleOK,
            hasTransfertFichiers: $immeuble->hasTransfertFichiers    
        );
    }
}
