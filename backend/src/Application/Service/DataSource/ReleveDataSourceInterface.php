<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

use App\Application\Dto\Input\Releve\GenerateReleveInputDto;

interface ReleveDataSourceInterface
{
    public function fetchPostReleve(GenerateReleveInputDto $inputDto): object;
}
