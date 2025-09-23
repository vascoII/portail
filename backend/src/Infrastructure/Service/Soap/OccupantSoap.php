<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Input\Occupant\ExportAnomaliesInputDto;
use App\Application\Dto\Input\Occupant\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\ExportInterventionsInputDto;
use App\Application\Dto\Input\Occupant\ExportLeaksInputDto;
use App\Application\Dto\Input\Occupant\ListAnomaliesInputDto;
use App\Application\Dto\Input\Occupant\ListDysfunctionsInputDto;
use App\Application\Dto\Input\Occupant\ListInterventionsInputDto;
use App\Application\Dto\Input\Occupant\ListLeaksInputDto;
use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Input\Occupant\ShowUseInputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Domain\Service\Soap\OccupantSoapInterface;
use App\Infrastructure\Hydrator\OccupantHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class OccupantSoap implements OccupantSoapInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly OccupantHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function alertesService(AlertesInputDto $inputDto): array
  {
    // TODO: Implement alertesService logic
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

  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): array
  {
    // TODO: Implement listAnomaliesService logic
    return [];
  }

  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): array
  {
    // TODO: Implement listDysfunctionsService logic
    return [];
  }

  public function listInterventionsService(ListInterventionsInputDto $inputDto): array
  {
    // TODO: Implement listInterventionsService logic
    return [];
  }

  public function listLeaksService(ListLeaksInputDto $inputDto): array
  {
    // TODO: Implement listLeaksService logic
    return [];
  }

  public function myAccountService(MyAccountInputDto $inputDto): array
  {
    // TODO: Implement myAccountService logic
    return [];
  }

  public function showEauReleveService(ShowEauReleveInputDto $inputDto): array
  {
    // TODO: Implement showEauReleveService logic
    return [];
  }

  public function showInterventionService(ShowInterventionInputDto $inputDto): array
  {
    // TODO: Implement showInterventionService logic
    return [];
  }

  public function showNoteReleveService(ShowNoteReleveInputDto $inputDto): array
  {
    // TODO: Implement showNoteReleveService logic
    return [];
  }

  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): array
  {
    // TODO: Implement showRepartReleveService logic
    return [];
  }

  public function showService(ShowUseInputDto $inputDto): array
  {
    // TODO: Implement showService logic
    return [];
  }

  public function simulateurService(SimulateurInputDto $inputDto): array
  {
    // TODO: Implement simulateurService logic
    return [];
  }
}
