<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Builder;

use App\Application\Dto\Output\Document\GetReportExcelDataSourceOutputDto;
use App\Application\Dto\Output\Document\GetReportExcelOutputDto;
use App\Application\Service\Builder\ExcelReportBuilderInterface;

final class ExcelReportBuilder implements ExcelReportBuilderInterface
{
    public function generateDocumentExcelService(GetReportExcelDataSourceOutputDto $outputDto): GetReportExcelOutputDto
    {
        if (empty($outputDto->excelContent)) {
            throw new \RuntimeException('Le contenu Excel est vide.');
        }

        if ($this->isValidBase64($outputDto->excelContent)) {
            $binaryContent = base64_decode($outputDto->excelContent);
        } else {
            $binaryContent = $outputDto->excelContent; // binaire pur
        }

        return new GetReportExcelOutputDto(
            content: $binaryContent,
            mimeType: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            filename: 'rapport.xlsx',
            length: (string) strlen($binaryContent)
        );
    }

    private function isValidBase64(string $data): bool
    {
        $decoded = base64_decode($data, true);

        return false !== $decoded && base64_encode($decoded) === $data;
    }
}
