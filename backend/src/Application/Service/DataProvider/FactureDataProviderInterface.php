<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Facture\ListFacturesOutputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;

interface FactureDataProviderInterface
{
    public function generateFacturePdfService(GetReportInputDto $inputDto): GetReportOutputDto;

    public function listFacturesService(): ListFacturesOutputDto;
}
