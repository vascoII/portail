<?php

declare(strict_types=1);

namespace App\Application\Factory\Logement;

use App\Domain\Entity\Logement;

final class LogementEntityFactory 
{
    public function createLogementFromRaw(object $raw): Logement
    {
        return new Logement(
            pkLogement: $raw->Logement->PkLogement,
            numBatiment: $raw->Logement->NumBatiment,
            adrBatiment: $raw->Logement->AdrBatiment,
            numEscalier: $raw->Logement->NumEscalier,
            adrEscalier: $raw->Logement->AdrEscalier,
            numEtage: $raw->Logement->NumEtage,
            numOrdre: $raw->Logement->NumOrdre,
            type: $raw->Logement->Type
        );
    }
    /**
     * @param object[] $rawList
     * @return Logement[]
     */
    public function createManyLogementsFromRawList(array $rawList): array
    {
        return array_map([$this, 'createLogementFromRaw'], $rawList);
    }
}
