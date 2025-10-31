<?php

declare(strict_types=1);

namespace App\Application\Service\Builder;

use App\Application\Dto\Output\Document\GetReportExcelDataSourceOutputDto;
use App\Application\Dto\Output\Document\GetReportExcelOutputDto;

interface ExcelReportBuilderInterface
{
    public function generateDocumentExcelService(GetReportExcelDataSourceOutputDto $reportExcelDataSourceOutputDto): GetReportExcelOutputDto;
}
