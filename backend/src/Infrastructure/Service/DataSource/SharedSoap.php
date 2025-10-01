<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Shared\GetDetailsDepannageInpuDto;
use App\Application\Dto\Input\Shared\GetExcelInpuDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Input\Shared\GetReportByTokenInputDto;
use App\Application\Service\DataSource\SharedDataSourceInterface;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Hydrator\SharedHydrator;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\DataSource\SoapClient;

final class SharedSoap implements SharedDataSourceInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly SharedHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function fetchGetDetailsDepannage(GetDetailsDepannageInpuDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetDetailsDepannage($inputDto);
    return $this->soapClient->call('GetDetailsDepannage', $soapRequest);
  }

  public function fetchGetExcel(GetExcelInpuDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetExcel($inputDto);
    return $this->soapClient->call('GetExcel', $soapRequest);
  }

  public function fetchGetReport(GetReportInputDto $inputDto): object
  {
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    $soapRequest = $this->hydrator->hydrateGetReport($inputDto);
    return $this->soapClient->call('GetReport', $soapRequest);
  }
  
  public function fetchGetReportByToken(GetReportByTokenInputDto $inputDto): object
  {
      $authContext = $this->getAuthContext();
      $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
      $soapRequest = $this->hydrator->hydrateGetReportByToken($inputDto);
      return $this->soapClient->call('GetReportByToken', $soapRequest);  
  }

}
