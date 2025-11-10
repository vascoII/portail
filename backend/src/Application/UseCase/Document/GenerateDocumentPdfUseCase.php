<?php

declare(strict_types=1);

namespace App\Application\UseCase\Document;

use App\Application\Dto\Output\Document\SoapOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataProvider\DocumentDataProviderInterface;

final class GenerateDocumentPdfUseCase
{
    public const CALLBACK_PATH = '/api/document/receive';

    public function __construct(
        private readonly DocumentDataProviderInterface $documentDataProvider,
        private readonly AuthServiceInterface $authService,
        private readonly string $callBackUrlBase,
    ) {}

    /**
     * @param string $reportType Type de rapport (ex: FACTURE, RELEVE_EAU_IMMEUBLE, etc.)
     * @param mixed  $inputDto   Input DTO (any of the Generate*DocumentInputDto)
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
            'FACTURE' => [
                'PKFACTURE' => $inputDto->pkFacture,
                'CALLBACKURL' => $this->callBackUrlBase . self::CALLBACK_PATH,
            ],
            'CR_INTERVENTION' => [
                'WORKORDERNUMBER' => $inputDto->workOrderNumber,
                'CALLBACKURL' => $this->callBackUrlBase . self::CALLBACK_PATH,
            ],
            'RELEVE_IMMEUBLE' => [
                'PKRELEVE' => $inputDto->pkReleve,
                'CALLBACKURL' => $this->callBackUrlBase . self::CALLBACK_PATH,
            ],
            'LIVRET_INTER_SYNTHESE' => array_filter([
                'PKIMMEUBLE' => $inputDto->pkImmeuble ?? null,
                'DATE1' => $inputDto->date1,
                'DATE2' => $inputDto->date2,
                'CALLBACKURL' => $this->callBackUrlBase . self::CALLBACK_PATH,
            ], fn ($val) => null !== $val),
            'LIVRET_INTER_DETAIL' => array_filter([
                'PKIMMEUBLE' => $inputDto->pkImmeuble ?? null,
                'DATE1' => $inputDto->date1,
                'DATE2' => $inputDto->date2,
                'CALLBACKURL' => $this->callBackUrlBase . self::CALLBACK_PATH,
            ], fn ($val) => null !== $val),
            'REPART_LOGEMENT' => [
                'PKIMMEUBLE' => $inputDto->pkImmeuble,
                'PKLOGEMENT' => $inputDto->pkLogement,
                'CALLBACKURL' => $this->callBackUrlBase . self::CALLBACK_PATH,
            ],
            'RELEVE_OCCUPANT' => [
                'PKOCCUPANT' => $inputDto->pkOccupant,
                'TYPEERC' => 'EAU',
                'CALLBACKURL' => $this->callBackUrlBase . self::CALLBACK_PATH,
            ],
            'REPART_OCCUPANT' => [
                'PKIMMEUBLE' => $inputDto->pkImmeuble,
                'PKOCCUPANT' => $inputDto->pkOccupant,
                'CALLBACKURL' => $this->callBackUrlBase . self::CALLBACK_PATH,
            ],
            'NOTE_INFO_MENSUELLE' => array_filter([
                'PKOCCUPANT' => $inputDto->pkOccupant,
                'PKIMMEUBLE' => $inputDto->pkImmeuble,
                'TYPEERC' => $inputDto->typeEnergie,
                'CALLBACKURL' => $this->callBackUrlBase . self::CALLBACK_PATH,
            ], fn ($val) => null !== $val),
            default => []
        };
    }
}
