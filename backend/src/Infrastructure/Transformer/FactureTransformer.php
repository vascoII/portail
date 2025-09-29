<?php

declare(strict_types=1);

namespace App\Infrastructure\Transformer;

use App\Application\Dto\Output\Facture\IndexOutputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;

final class FactureTransformer
{
  /**
   * Transform raw response to IndexOutputDto
   */
  public function transformIndex(object $response): IndexOutputDto
  {
    if (!isset($response['ListeFactures'])) {
      return new IndexOutputDto([]);
    }

    $listFactures = $response['ListeFactures'];
    if (isset($listFactures['facture'])) {
      $listFactures = $listFactures['facture'];
    }

    // Ensure it's always an array
    if (!is_array($listFactures)) {
      $listFactures = [$listFactures];
    }

    // Format the data similar to the original controller
    foreach ($listFactures as &$facture) {
      if (isset($facture['DateEdition'])) {
        $facture['DateEdition'] = date('d/m/Y', strtotime($facture['DateEdition']));
      }
      if (isset($facture['MontantTotalHT'])) {
        $facture['MontantTotalHT'] = number_format($facture['MontantTotalHT'], 2, ',', ' ') . ' €';
      }
      if (isset($facture['MontantTotalTTC'])) {
        $facture['MontantTotalTTC'] = number_format($facture['MontantTotalTTC'], 2, ',', ' ') . ' €';
      }
      if (isset($facture['MontantTotalAPayer'])) {
        $facture['MontantTotalAPayer'] = number_format($facture['MontantTotalAPayer'], 2, ',', ' ') . ' €';
      }
    }

    return new IndexOutputDto($listFactures);
  }

  /**
   * Transform raw response to ReportOutputDto
   */
  public function transformReport(object $response): ReportOutputDto
  {
    return new ReportOutputDto(
      $response['PDF_DATA'] ?? '',
      !empty($response['PDF_DATA'] ?? '')
    );
  }

  /**
   * Format date from format to application format
   */
  private function formatDate(?string $date): ?string
  {
    if (!$date) {
      return null;
    }

    try {
      $dateTime = new \DateTime($date);
      return $dateTime->format('Y-m-d');
    } catch (\Exception $e) {
      return null;
    }
  }

  /**
   * Format amount from format to application format
   */
  private function formatAmount(?string $amount): ?float
  {
    if (!$amount) {
      return null;
    }

    return (float) str_replace(',', '.', $amount);
  }
}
