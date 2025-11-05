<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Dto\Input\Releve\GenerateReleveInputDto;

interface ReleveDataProviderInterface
{
    public function generateReleveService(GenerateReleveInputDto $inputDto): SuccessOutputDto;
}
