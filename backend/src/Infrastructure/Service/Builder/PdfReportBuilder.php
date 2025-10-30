<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Builder;

use App\Application\Dto\Output\External\GetReportByTokenDataSourceOutputDto;
use App\Application\Dto\Output\External\GetReportByTokenOutputDto;
use App\Application\Service\Builder\PdfReportBuilderInterface;

final class PdfReportBuilder implements PdfReportBuilderInterface
{
    public function generateDocumentReportByTokenService(GetReportByTokenDataSourceOutputDto $outputDto): GetReportByTokenOutputDto {
        if (empty($outputDto->pdfContent)) {
            throw new \RuntimeException('Le contenu PDF est vide.');
        }

        if ($this->isValidBase64($outputDto->pdfContent)) {
            $binaryContent = base64_decode($outputDto->pdfContent);
        } else {
            $binaryContent = $outputDto->pdfContent; // binaire pur
        }

        return new GetReportByTokenOutputDto(
            content: $binaryContent,
            mimeType: 'application/pdf',
            filename: 'document.pdf',
            length: (string) strlen($binaryContent)
        );
    }

    
    private function isValidBase64(string $data): bool
    {
        $decoded = base64_decode($data, true);
        return $decoded !== false && base64_encode($decoded) === $data;
    }

}
