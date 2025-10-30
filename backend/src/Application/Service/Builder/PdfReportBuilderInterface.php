<?php

declare(strict_types=1);

namespace App\Application\Service\Builder;

use App\Application\Dto\Output\External\GetReportByTokenDataSourceOutputDto;
use App\Application\Dto\Output\External\GetReportByTokenOutputDto;

interface PdfReportBuilderInterface
{
  public function generateDocumentReportByTokenService(GetReportByTokenDataSourceOutputDto $reportByTokenDataSourceOutputDto): GetReportByTokenOutputDto;
}
