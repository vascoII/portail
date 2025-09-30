<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Facture\IndexOutputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;
use App\Application\Dto\Output\Facture\ListFactureOutputDto;
use App\Application\Dto\Output\Facture\FactureOutputDto;
use DateTimeImmutable;

final class FactureTransformer
{
  /**
   * Transform raw response to IndexOutputDto
   */
  public function transformIndex(object $dataSourceResult): IndexOutputDto
  {
    $rawList = (array) $dataSourceResult->ListeFactures;

    // Normalisation : si 'facture' est un tableau ou un objet unique
    $factures = $rawList['facture'] ?? [];
    if (!is_array($factures)) {
        $factures = [$factures];
    }

    $dtoList = [];

    foreach ($factures as $facture) {
        $dtoList[] = new FactureOutputDto(
            pkFacture: (int) $facture->PKFacture,
            numFacture: (string) $facture->NumFacture,
            dateEdition: new DateTimeImmutable($facture->DateEdition),
            dateDebut: new DateTimeImmutable($facture->DateDebut),
            dateFin: new DateTimeImmutable($facture->DateFin),
            montantTotalHT: (float) $facture->MontantTotalHT,
            montantTotalTTC: (float) $facture->MontantTotalTTC,
            montantTotalAPayer: (float) $facture->MontantTotalAPayer,
            idImm: (string) $facture->IDImm,
            codeGestio: (string) $facture->CodeGestio,
            cp: (string) $facture->CP,
            adresse: (string) $facture->Adresse,
            ville: (string) $facture->Ville
        );
    }

    return new IndexOutputDto(
        listFactures: new ListFactureOutputDto($dtoList)
    );
  }

  /**
   * Transform raw response to ReportOutputDto
   */
  public function transformReport(object $dataSourceResult): ReportOutputDto
  {
    return new ReportOutputDto(
      "Factures", $dataSourceResult
    );
  }
}
