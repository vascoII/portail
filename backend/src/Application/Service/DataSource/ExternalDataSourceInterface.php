<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Shared\GetByIdStringInputDto;

interface ExternalDataSourceInterface
{
    public function fetchGetReportByToken(GetByIdStringInputDto $inputDto): string;
}
