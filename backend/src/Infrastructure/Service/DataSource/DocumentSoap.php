<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataSource\DocumentDataSourceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Hydrator\DocumentHydrator;

final class DocumentSoap extends Soap implements DocumentDataSourceInterface
{
    public const LIVRET_INTER_LISTE = 'LIVRET_INTER_LISTE';
    public const PK_USER = 'PKUSER';

    public function __construct(
        SoapClient $soapClient,
        private readonly AuthServiceInterface $authService,
        private readonly DocumentHydrator $hydrator
    ) {
        parent::__construct($soapClient);
    }

    public function fetchInsertPrintJobs(string $reportType, array $paramsFiltres): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        $soapRequest = $this->hydrator->hydrateInsertPrintJobs($reportType, $paramsFiltres);

        return $this->safeCall('InsertPrintJobs', $soapRequest);
    }

    public function getExcel(string $reportType, array $paramsFiltres): object|string
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        if (self::LIVRET_INTER_LISTE === $reportType) {
            $paramsFiltres[self::PK_USER] = $authContext->pkUser;
            $soapRequest = $this->hydrator->hydrateGetExcel($reportType, $paramsFiltres);

            return $this->safeCall('GetExcel', $soapRequest);
        }

        $soapRequest = $this->hydrator->hydrateGetExcel($reportType, $paramsFiltres);

        return $this->safeCall($reportType, $soapRequest);
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
