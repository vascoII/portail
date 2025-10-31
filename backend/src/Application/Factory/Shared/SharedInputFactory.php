<?php

declare(strict_types=1);

namespace App\Application\Factory\Shared;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Shared\GetByIdStringInputDto;
use App\Application\Dto\Input\Shared\GetDetailsDepannageInpuDto;
use App\Application\Dto\Input\Shared\GetExcelInpuDto;
use App\Application\Dto\Input\Shared\GetReportByTokenInputDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Input\Shared\ReportTokenInputDto;
use Symfony\Component\HttpFoundation\Request;

final class SharedInputFactory
{
    public function createGetDetailsDepannageFromRequest(Request $request): GetDetailsDepannageInpuDto
    {
        return new GetDetailsDepannageInpuDto((string) $request->query->get('pkDepannage'));
    }

    public function createGetExcelFromRequest(Request $request): GetExcelInpuDto
    {
        return new GetExcelInpuDto(
            (string) $request->query->get('type'),
            (string) $request->query->get('params')
        );
    }

    public function createGetReportByTokenFromRequest(Request $request): GetReportByTokenInputDto
    {
        return new GetReportByTokenInputDto((string) $request->query->get('token'));
    }

    public function createGetReportFromRequest(Request $request): GetReportInputDto
    {
        return new GetReportInputDto(
            (string) $request->query->get('type'),
            (string) $request->query->get('params')
        );
    }

    public function createGetReportFromRouteWithCustomParams(Request $request, string $type, string $paramName, string $paramPrefix): GetReportInputDto
    {
        $paramValue = (string) $request->attributes->get($paramName);
        $params = $paramPrefix . '=' . $paramValue;

        return new GetReportInputDto($type, $params);
    }

    public function createIdStringFromRoute(Request $request): GetByIdStringInputDto
    {
        return new GetByIdStringInputDto((string) $request->attributes->get('id'));
    }

    public function createReportTokenFromRequest(Request $request): ReportTokenInputDto
    {
        return new ReportTokenInputDto((string) $request->query->get('token'));
    }

    public function getIdIntFromRoute(Request $request): GetByIdIntInputDto
    {
        return new GetByIdIntInputDto(id: (int) $request->attributes->get('id'));
    }
}
