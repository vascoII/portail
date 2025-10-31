<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Shared\GetDetailsDepannageInpuDto;
use App\Application\Dto\Input\Shared\GetExcelInpuDto;
use App\Application\Dto\Input\Shared\GetReportByTokenInputDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;

final class SharedHydrator extends Hydrator
{
    public function hydrateGetDetailsDepannage(GetDetailsDepannageInpuDto $inputDto): object
    {
        return (object) [
            'WorkOrderNumber' => $inputDto->pkDepannage,
        ];
    }

    public function hydrateGetExcel(GetExcelInpuDto $inputDto): object
    {
        return (object) [
            'ReportType' => $inputDto->type,
            'ParamsFiltres' => $inputDto->params,
        ];
    }

    public function hydrateGetReport(GetReportInputDto $inputDto): object
    {
        return (object) [
            'ReportType' => $inputDto->type,
            'ParamsFiltres' => $inputDto->params,
        ];
    }

    public function hydrateGetReportByToken(GetReportByTokenInputDto $inputDto): object
    {
        return (object) [
            'token' => $inputDto->token,
        ];
    }

    public function hydratePatchCgu(int $pkUser): object
    {
        return (object) [
            'SuperLoginID' => $this->superLoginID,
            'SuperPassword' => $this->superPassword,
            'PKUser' => $pkUser,
            'CGU' => 'O',
        ];
    }

    public function hydrateUpdateEmailFromPKUser(int $pkUser, string $email): object
    {
        return (object) [
            'SuperLoginID' => $this->superLoginID,
            'SuperPassword' => $this->superPassword,
            'PKUser' => $pkUser,
            'Email' => $email,
        ];
    }
}
