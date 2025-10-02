<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Domain\Entity\Facture;
use App\Application\Dto\Output\Facture\GetFacturesOutputDto;
use DateTimeImmutable;

final class FactureTransformer
{
  /**
   * Transform raw response to IndexOutputDto
   */
  public function transformIndex(object $dataSourceResult): GetFacturesOutputDto
  {
    $rawList = (array) $dataSourceResult->ListeFactures;

    // Normalisation : si 'facture' est un tableau ou un objet unique
    $factures = $rawList['facture'] ?? [];
    if (!is_array($factures)) {
      $factures = [$factures];
    }

    $dtoList = [];

    foreach ($factures as $facture) {
      $dtoList[] = new Facture(
        pkFacture: (int) $facture->PKFacture,
        numFacture: (string) $facture->NumFacture,
        dateEdition: new \DateTimeImmutable($facture->DateEdition),
        dateDebut: new DateTimeImmutable($facture->DateDebut),
        dateFin: new DateTimeImmutable($facture->DateFin),
        montantTotalHt: (float) $facture->MontantTotalHT,
        montantTotalTtc: (float) $facture->MontantTotalTTC,
        montantTotalAPayer: (float) $facture->MontantTotalAPayer,
        idImm: (string) $facture->IDImm,
        codeGestio: (string) $facture->CodeGestio,
        cp: (string) $facture->CP,
        adresse: (string) $facture->Adresse,
        ville: (string) $facture->Ville
      );
    }

    return new GetFacturesOutputDto(
      factures: $dtoList
    );
  }

  /**
   * Transform raw response to ReportOutputDto
   */
  public function transformReport(object $dataSourceResult): GetReportOutputDto
  {
    $binary = (string) $dataSourceResult;
    $filename = 'releve-' . date('Y-m-d') . '.pdf';
    return new GetReportOutputDto(
      data: $binary,
      filename: $filename,
      length: strlen($binary)
    );
  }
}
