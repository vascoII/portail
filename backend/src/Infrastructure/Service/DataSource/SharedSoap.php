<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Shared\GetDetailsDepannageInpuDto;
use App\Application\Dto\Input\Shared\GetExcelInpuDto;
use App\Application\Dto\Input\Shared\GetReportByTokenInputDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataSource\SharedDataSourceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Hydrator\SharedHydrator;

final class SharedSoap extends Soap implements SharedDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly SharedHydrator $hydrator,
        private readonly AuthServiceInterface $authService
    ) {
        parent::__construct($soapClient);
    }

    public function fetchGetDetailsDepannage(GetDetailsDepannageInpuDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetDetailsDepannage($inputDto);

        return $this->safeCall('GetDetailsDepannage', $soapRequest);
    }

    public function fetchGetExcel(GetExcelInpuDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetExcel($inputDto);

        return $this->safeCall('GetExcel', $soapRequest);
    }

    public function fetchGetReport(GetReportInputDto $inputDto): string
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetReport($inputDto);

        return $this->safeCall('GetReport', $soapRequest);
    }

    public function fetchGetReportByToken(GetReportByTokenInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateGetReportByToken($inputDto);

        return $this->safeCall('GetReportByToken', $soapRequest);
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
