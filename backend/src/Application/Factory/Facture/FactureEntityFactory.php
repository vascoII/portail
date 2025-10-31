<?php

declare(strict_types=1);

namespace App\Application\Factory\Facture;

use App\Domain\Entity\Facture;

class FactureEntityFactory
{
    public function createFromRaw(object $raw): Facture
    {
        return new Facture(
            pkFacture: (int) $raw->PKFacture,
            numFacture: (string) $raw->NumFacture,
            dateEdition: new \DateTimeImmutable($raw->DateEdition),
            dateDebut: new \DateTimeImmutable($raw->DateDebut),
            dateFin: new \DateTimeImmutable($raw->DateFin),
            montantTotalHt: (float) $raw->MontantTotalHT,
            montantTotalTtc: (float) $raw->MontantTotalTTC,
            montantTotalAPayer: (float) $raw->MontantTotalAPayer,
            idImm: (string) $raw->IDImm,
            codeGestio: (string) $raw->CodeGestio,
            cp: (string) $raw->CP,
            adresse: (string) $raw->Adresse,
            ville: (string) $raw->Ville
        );
    }

    /**
     * @param object[] $rawList
     *
     * @return Facture[]
     */
    public function createManyFromRawList(array $rawList): array
    {
        return array_map([$this, 'createFromRaw'], $rawList);
    }
}
