<?php

declare(strict_types=1);

namespace App\Application\UseCase\Document;

use App\Application\Dto\Output\Document\GetReportExcelOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\Builder\ExcelReportBuilderInterface;
use App\Application\Service\DataProvider\DocumentDataProviderInterface;

final class GenerateDocumentExcelUseCase
{
    public function __construct(
        private readonly DocumentDataProviderInterface $documentDataProvider,
        private readonly ExcelReportBuilderInterface $reportBuilderInterface,
        private readonly AuthServiceInterface $authService
    ) {}

    /**
     * @param string $reportType Type de rapport (ex: GetInfosAnomaliesByImmeuble, etc.)
     * @param mixed  $inputDto   Input DTO (any of the Generate*DocumentInputDto)
     */
    public function execute(string $reportType, mixed $inputDto): GetReportExcelOutputDto
    {
        // Extract params array from inputDto based on its type
        $paramsFiltres = $this->extractParamsFromInput($reportType, $inputDto);

        $reportExcelOutputDto = $this->documentDataProvider->generateExcelDataDocumentService('EXCEL', $reportType, $paramsFiltres);

        return $this->reportBuilderInterface->generateDocumentExcelService($reportExcelOutputDto);

        return $this->documentDataProvider->generateExcelDocumentService('EXCEL', $reportType, $paramsFiltres);
    }

    private function extractParamsFromInput(string $reportType, mixed $inputDto): array
    {
        return match ($reportType) {
            'GetInfosAnomaliesByImmeuble', 'GetInfosFuitesByImmeuble' => array_filter([
                'PKIMMEUBLE' => $inputDto->pkImmeuble,
                'PKLOGEMENT' => $inputDto->pkLogement,
                'PKOCCUPANT' => $inputDto->pkOccupant,
                'PKAPPAREIL' => $inputDto->pkAppareil,
            ], fn ($val) => null !== $val),
            'GetInfosDepannagesByImmeuble', 'GetInfosDysfonctionnementsByImmeuble' => array_filter([
                'PKIMMEUBLE' => $inputDto->pkImmeuble,
                'PKLOGEMENT' => $inputDto->pkLogement,
                'PKOCCUPANT' => $inputDto->pkOccupant,
            ], fn ($val) => null !== $val),
            'LIVRET_INTER_LISTE' => array_filter([
                'PKIMMEUBLE' => $inputDto->pkImmeuble ?? null,
                'DATE1' => $inputDto->date1,
                'DATE2' => $inputDto->date2,
            ], fn ($val) => null !== $val),
            default => []
        };
    }
}
