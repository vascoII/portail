<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Document\GetReportExcelDataSourceOutputDto;
use App\Application\Dto\Output\Document\SoapOutputDto;
use App\Application\Service\Transformer\DocumentTransformerInterface;

final class DocumentTransformer implements DocumentTransformerInterface
{
    public function transformGetExcel(string $dataSourceResult): GetReportExcelDataSourceOutputDto
    {
        // Extract the ID from the SOAP response
        // Assuming the SOAP response is string
        $excelContent = is_string($dataSourceResult) && ! is_null($dataSourceResult)
        ? $dataSourceResult
        : null;

        return new GetReportExcelDataSourceOutputDto(excelContent: $excelContent);
    }

    public function transformInsertPrintJobs(object $dataSourceResult): SoapOutputDto
    {
        // Extract the ID from the SOAP response
        // Assuming the SOAP response contains an ID field
        $id = is_object($dataSourceResult) && isset($dataSourceResult->InsertPrintJobsResult)
          ? (int) $dataSourceResult->InsertPrintJobsResult
          : 0;

        return new SoapOutputDto(id: $id);
    }
}
