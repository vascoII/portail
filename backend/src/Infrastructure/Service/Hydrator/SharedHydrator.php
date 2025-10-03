<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Shared\GetDetailsDepannageInpuDto;
use App\Application\Dto\Input\Shared\GetExcelInpuDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Input\Shared\GetReportByTokenInputDto;

final class SharedHydrator
{
    public function __construct(
        private readonly string $superLoginID,
        private readonly string $superPassword,
        private readonly string $adminSessionId
    ) {}

    public function hydrateGetDetailsDepannage(GetDetailsDepannageInpuDto $inputDto): object
    {
        return (object) [
            'WorkOrderNumber' => $inputDto->pkDepannage,
        ];
    }

    public function hydrateGetExcel(GetExcelInpuDto $inputDto): object
    {
        return (object) [
            'ReportType'    => $inputDto->type,
            'ParamsFiltres' => $inputDto->params
        ];
    }

    public function hydrateGetReport(GetReportInputDto $inputDto): object
    {
        return (object) [
            'ReportType'    => $inputDto->type,
            'ParamsFiltres' => $inputDto->params
        ];
    }

    public function hydrateGetReportByToken(GetReportByTokenInputDto $inputDto): object
    {
        return (object) [
            'token'    => $inputDto->token
        ];
    }
}
