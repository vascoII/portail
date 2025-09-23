<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\GestionParc\IndexInputDto;
use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Input\GestionParc\ExportInterventionsInputDto;
use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Input\GestionParc\ShowInputDto;
use App\Application\Dto\Input\GestionParc\ExportLeaksInputDto;
use App\Application\Dto\Input\GestionParc\ExportAnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\ListInterventionsInputDto;
use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Input\GestionParc\ListLeaksInputDto;
use App\Application\Dto\Input\GestionParc\ListAnomaliesInputDto;
use App\Application\Dto\Input\GestionParc\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\GestionParc\ListDysfunctionsInputDto;
use App\Domain\Service\Soap\GestionParcSoapInterface;
use App\Infrastructure\Hydrator\GestionParcHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class GestionParcSoap implements GestionParcSoapInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly GestionParcHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function indexService(IndexInputDto $inputDto): array
  {
    // TODO: Implement indexService logic
    return [];
  }

  public function interventionService(InterventionInputDto $inputDto): array
  {
    // TODO: Implement interventionService logic
    return [];
  }

  public function reportService(ReportInputDto $inputDto): array
  {
    // TODO: Implement reportService logic
    return [];
  }

  public function showService(ShowInputDto $inputDto): array
  {
    // TODO: Implement showService logic
    return [];
  }

  public function listInterventionsService(ListInterventionsInputDto $inputDto): array
  {
    // TODO: Implement listInterventionsService logic
    return  [];
  }

  public function showInterventionService(ShowInterventionInputDto $inputDto): array
  {
    // TODO: Implement showInterventionService logic
    return [];
  }

  public function filterResultService(FilterResultInputDto $inputDto): array
  {
    // TODO: Implement filterResultService logic
    return [];
  }

  public function listLeaksService(ListLeaksInputDto $inputDto): array
  {
    // TODO: Implement listLeaksService logic
    return [];
  }

  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): array
  {
    // TODO: Implement listAnomaliesService logic
    return [];
  }

  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): array
  {
    // TODO: Implement exportInterventionsService logic
    return [];
  }

  public function exportLeaksService(ExportLeaksInputDto $inputDto): array
  {
    // TODO: Implement exportLeaksService logic
    return [];
  }

  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): array
  {
    // TODO: Implement exportAnomaliesService logic
    return [];
  }

  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): array
  {
    // TODO: Implement exportDysfunctionsService logic
    return [];
  }

  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): array
  {
    // TODO: Implement listDysfunctionsService logic
    return [];
  }
}
