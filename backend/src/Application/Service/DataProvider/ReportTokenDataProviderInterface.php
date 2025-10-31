<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetReportByTokenInputDto;
use App\Application\Dto\Output\Shared\GetReportByTokenOutputDto;

interface ReportTokenDataProviderInterface
{
    public function reportService(GetReportByTokenInputDto $inputDto): GetReportByTokenOutputDto;
}
