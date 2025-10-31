<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Output\Document\GetReportExcelDataSourceOutputDto;
use App\Application\Dto\Output\Document\SoapOutputDto;
use App\Application\Service\DataProvider\DocumentDataProviderInterface;
use App\Application\Service\DataSource\DocumentDataSourceInterface;
use App\Application\Service\Transformer\DocumentTransformerInterface;
use App\Application\Service\Transformer\SharedTransformerInterface;

final class DocumentDataProvider implements DocumentDataProviderInterface
{
    public function __construct(
        private DocumentDataSourceInterface $documentDataSource,
        private readonly SharedTransformerInterface $sharedTransformer,
        private readonly DocumentTransformerInterface $documentTransformer
    ) {}

    public function generateExcelDataDocumentService(string $format, string $reportType, array $paramsFiltres): GetReportExcelDataSourceOutputDto
    {
        $rawData = $this->documentDataSource->getExcel($reportType, $paramsFiltres);

        return $this->documentTransformer->transformGetExcel($rawData);
    }

    public function generatePdfDocumentService(string $format, string $reportType, array $paramsFiltres): SoapOutputDto
    {
        $rawData = $this->documentDataSource->fetchInsertPrintJobs($reportType, $paramsFiltres);

        return $this->documentTransformer->transformInsertPrintJobs($rawData);
    }
}
