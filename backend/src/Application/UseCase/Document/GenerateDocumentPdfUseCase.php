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
   * @param array<string, string> $paramsFiltres Paramètres pour le filtrage
   * @return SoapOutputDto
   */
  public function execute(string $reportType, array $paramsFiltres): SoapOutputDto
  {
    return $this->documentDataProvider->generateDocumentService('PDF', $reportType, $paramsFiltres);
  }
}
