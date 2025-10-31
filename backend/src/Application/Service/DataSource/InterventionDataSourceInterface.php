<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Intervention\GetCasesByEmailInpuDto;

interface InterventionDataSourceInterface
{
    public function fetchGetCases(GetCasesByEmailInpuDto $input): object;
}
