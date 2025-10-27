<?php

declare(strict_types=1);

namespace App\Application\UseCase\Document;

use App\Application\Dto\Output\Document\SoapOutputDto;
use App\Application\Service\DataProvider\DocumentDataProviderInterface;
use App\Application\Service\Auth\AuthServiceInterface;

final class GenerateDocumentExcelUseCase
{
  public function __construct(
    private readonly DocumentDataProviderInterface $documentDataProvider,
    private readonly AuthServiceInterface $authService
  ) {}

  /**
   * @param string $reportType Type de rapport (ex: GetInfosAnomaliesByImmeuble, etc.)
   * @param mixed $inputDto Input DTO (any of the Generate*DocumentInputDto)
   * @return SoapOutputDto
   */
  public function execute(string $reportType, mixed $inputDto): SoapOutputDto
  {
    // Extract params array from inputDto based on its type
    $paramsFiltres = $this->extractParamsFromInput($reportType, $inputDto);

    return $this->documentDataProvider->generateDocumentService('EXCEL', $reportType, $paramsFiltres);
  }

  private function extractParamsFromInput(string $reportType, mixed $inputDto): array
  {
    return match ($reportType) {
      'GetInfosAnomaliesByImmeuble', 'GetInfosFuitesByImmeuble' => array_filter([
        'PKIMMEUBLE' => $inputDto->pkImmeuble,
        'PKLOGEMENT' => $inputDto->pkLogement,
        'PKOCCUPANT' => $inputDto->pkOccupant,
        'PKAPPAREIL' => $inputDto->pkAppareil
      ], fn($val) => $val !== null),
      'GetInfosDepannagesByImmeuble', 'GetInfosDysfonctionnementsByImmeuble' => array_filter([
        'PKIMMEUBLE' => $inputDto->pkImmeuble,
        'PKLOGEMENT' => $inputDto->pkLogement,
        'PKOCCUPANT' => $inputDto->pkOccupant
      ], fn($val) => $val !== null),
      default => []
    };
  }
}
