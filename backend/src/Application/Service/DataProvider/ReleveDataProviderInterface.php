<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Shared\SuccessOutputDto;

interface ReleveDataProviderInterface
{
    public function listCasesService(): SuccessOutputDto;
}
