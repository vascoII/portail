<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Document\GetReportExcelDataSourceOutputDto;
use App\Application\Dto\Output\Document\SoapOutputDto;

interface DocumentDataProviderInterface
{
    public function generateExcelDataDocumentService(string $format, string $reportType, array $paramsFiltres): GetReportExcelDataSourceOutputDto;

    public function generatePdfDocumentService(string $format, string $reportType, array $paramsFiltres): SoapOutputDto;
}
