<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Logement\IndexInputDto;
use App\Application\Dto\Input\Logement\ShowInputDto;
use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Input\Logement\ListInterventionsInputDto;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use App\Application\Dto\Input\Logement\ListLeaksInputDto;
use App\Application\Dto\Input\Logement\ListDysfunctionsInputDto;
use App\Application\Dto\Input\Logement\ListAnomaliesInputDto;
use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Input\Logement\ExportInputDto;
use App\Application\Dto\Input\Logement\ExportInterventionsInputDto;
use App\Application\Dto\Input\Logement\ExportLeaksInputDto;
use App\Application\Dto\Input\Logement\ExportDysfunctionsInputDto;
use App\Application\Dto\Input\Logement\ExportAnomaliesInputDto;
use App\Application\Dto\Input\Logement\EditInputDto;
use App\Application\Dto\Input\Logement\CreateTicketInputDto;
use App\Application\Dto\Input\Logement\CreateTicketImmeubleInputDto;
use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use App\Application\Dto\Input\Logement\GuideInputDto;
use App\Application\Dto\Input\Logement\GetInfosAppareilInputDto;
use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;
use App\Domain\Service\Soap\LogementSoapInterface;
use App\Infrastructure\Hydrator\LogementHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class LogementSoap implements LogementSoapInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly LogementHydrator $hydrator,
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

  public function showService(ShowInputDto $inputDto): array
  {
    // TODO: Implement showService logic
    return [];
  }

  public function searchService(SearchInputDto $inputDto): array
  {
    // TODO: Implement searchService logic
    return [];
  }

  public function listInterventionsService(ListInterventionsInputDto $inputDto): array
  {
    // TODO: Implement listInterventionsService logic
    return [];
  }

  public function showInterventionService(ShowInterventionInputDto $inputDto): array
  {
    // TODO: Implement showInterventionService logic
    return [];
  }

  public function listLeaksService(ListLeaksInputDto $inputDto): array
  {
    // TODO: Implement listLeaksService logic
    return [];
  }

  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): array
  {
    // TODO: Implement listDysfunctionsService logic
    return [];
  }

  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): array
  {
    // TODO: Implement listAnomaliesService logic
    return [];
  }

  public function filterResultService(FilterResultInputDto $inputDto): array
  {
    // TODO: Implement filterResultService logic
    return [];
  }

  public function exportService(ExportInputDto $inputDto): array
  {
    // TODO: Implement exportService logic
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

  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): array
  {
    // TODO: Implement exportDysfunctionsService logic
    return [];
  }

  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): array
  {
    // TODO: Implement exportAnomaliesService logic
    return [];
  }

  public function editService(EditInputDto $inputDto): array
  {
    // TODO: Implement editService logic
    return [];
  }

  public function createTicketService(CreateTicketInputDto $inputDto): array
  {
    // TODO: Implement createTicketService logic
    return [];
  }

  public function createTicketImmeubleService(CreateTicketImmeubleInputDto $inputDto): array
  {
    // TODO: Implement createTicketImmeubleService logic
    return [];
  }

  public function getTicketOnwerService(GetTicketOnwerInputDto $inputDto): array
  {
    // TODO: Implement getTicketOnwerService logic
    return [];
  }

  public function guideService(GuideInputDto $inputDto): array
  {
    // TODO: Implement guideService logic
    return [];
  }

  public function getInfosAppareilService(GetInfosAppareilInputDto $inputDto): array
  {
    // TODO: Implement getInfosAppareilService logic
    return [];
  }

  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): array
  {
    // TODO: Implement showRepartReleveService logic
    return [];
  }
}
