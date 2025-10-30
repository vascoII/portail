<?php

declare(strict_types=1);

namespace App\Application\UseCase\Document;

use App\Application\Dto\Output\Document\SoapOutputDto;
use App\Application\Service\DataProvider\DocumentDataProviderInterface;
use App\Application\Service\Auth\AuthServiceInterface;

final class GenerateDocumentPdfUseCase
{
  public function __construct(
    private readonly DocumentDataProviderInterface $documentDataProvider,
    private readonly AuthServiceInterface $authService
  ) {}

  /**
   * @param string $reportType Type de rapport (ex: FACTURE, RELEVE_EAU_IMMEUBLE, etc.)
   * @param mixed $inputDto Input DTO (any of the Generate*DocumentInputDto)
   * @return SoapOutputDto
   */
  public function execute(string $reportType, mixed $inputDto): SoapOutputDto
  {
    // Extract params array from inputDto based on its type
    $paramsFiltres = $this->extractParamsFromInput($reportType, $inputDto);

    return $this->documentDataProvider->generatePdfDocumentService('PDF', $reportType, $paramsFiltres);
  }

  private function extractParamsFromInput(string $reportType, mixed $inputDto): array
  {
    return match ($reportType) {
      'FACTURE' => ['PKFACTURE' => $inputDto->pkFacture],
      'CR_INTERVENTION' => ['WORKORDERNUMBER' => $inputDto->workOrderNumber],
      'RELEVE_IMMEUBLE' => [
        'PKRELEVE' => $inputDto->pkReleve,
      ],
      'LIVRET_INTER_SYNTHESE' => array_filter([
        'PKIMMEUBLE' => $inputDto->pkImmeuble ?? null,
        'DATE1' => $inputDto->date1,
        'DATE2' => $inputDto->date2
      ], fn($val) => $val !== null),
      'LIVRET_INTER_DETAIL' => array_filter([
        'PKIMMEUBLE' => $inputDto->pkImmeuble ?? null,
        'DATE1' => $inputDto->date1,
        'DATE2' => $inputDto->date2
      ], fn($val) => $val !== null),
      'REPART_LOGEMENT' => [
        'PKIMMEUBLE' => $inputDto->pkImmeuble,
        'PKLOGEMENT' => $inputDto->pkLogement
      ],
      'RELEVE_OCCUPANT' => [
        'PKOCCUPANT' => $inputDto->pkOccupant,
        'TYPEERC' => 'EAU'
      ],
      'REPART_OCCUPANT' => [
        'PKIMMEUBLE' => $inputDto->pkImmeuble,
        'PKOCCUPANT' => $inputDto->pkOccupant
      ],
      'NOTE_INFO_MENSUELLE' => array_filter([
        'PKOCCUPANT' => $inputDto->pkOccupant,
        'PKIMMEUBLE' => $inputDto->pkImmeuble,
        'TYPEERC' => $inputDto->typeEnergie
      ], fn($val) => $val !== null),
      default => []
    };
  }
}
