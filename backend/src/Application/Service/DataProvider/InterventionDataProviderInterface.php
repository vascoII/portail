<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Intervention\GetCasesByEmailInpuDto;
use App\Application\Dto\Output\Intervention\ListCasesOutputDto;

interface InterventionDataProviderInterface
{
    public function listCasesService(GetCasesByEmailInpuDto $inputDto): ListCasesOutputDto;
}
