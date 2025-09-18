<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Output\Occupant\AlertesOutputDto;
use App\Application\Dto\Input\Occupant\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Occupant\ExportAnomaliesOutputDto;
use App\Application\Dto\Input\Occupant\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\ExportDysfunctionsOutputDto;
use App\Application\Dto\Input\Occupant\ExportInterventionsInputDto;
use App\Application\Dto\Output\Occupant\ExportInterventionsOutputDto;
use App\Application\Dto\Input\Occupant\ExportLeaksInputDto;
use App\Application\Dto\Output\Occupant\ExportLeaksOutputDto;
use App\Application\Dto\Input\Occupant\ListAnomaliesInputDto;
use App\Application\Dto\Output\Occupant\ListAnomaliesOutputDto;
use App\Application\Dto\Input\Occupant\ListDysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\ListDysfunctionsOutputDto;
use App\Application\Dto\Input\Occupant\ListInterventionsInputDto;
use App\Application\Dto\Output\Occupant\ListInterventionsOutputDto;
use App\Application\Dto\Input\Occupant\ListLeaksInputDto;
use App\Application\Dto\Output\Occupant\ListLeaksOutputDto;
use App\Application\Dto\Input\Occupant\MyAccountInputDto;
use App\Application\Dto\Output\Occupant\MyAccountOutputDto;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowEauReleveOutputDto;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Output\Occupant\ShowInterventionOutputDto;
use App\Application\Dto\Input\Occupant\ShowNoteReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowNoteReleveOutputDto;
use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowRepartReleveOutputDto;
use App\Application\Dto\Input\Occupant\ShowUseInputDto;
use App\Application\Dto\Output\Occupant\ShowOutputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Application\Dto\Output\Occupant\SimulateurOutputDto;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class OccupantSoap implements OccupantSoapInterface
{
  public function alertesService(AlertesInputDto $inputDto): AlertesOutputDto
  {
    // TODO: Implement alertesService logic
    return new AlertesOutputDto([]);
  }

  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    // TODO: Implement exportAnomaliesService logic
    return new ExportAnomaliesOutputDto(true);
  }

  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    // TODO: Implement exportDysfunctionsService logic
    return new ExportDysfunctionsOutputDto(true);
  }

  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    // TODO: Implement exportInterventionsService logic
    return new ExportInterventionsOutputDto(true);
  }

  public function exportLeaksService(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    // TODO: Implement exportLeaksService logic
    return new ExportLeaksOutputDto(true);
  }

  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    // TODO: Implement listAnomaliesService logic
    return new ListAnomaliesOutputDto([]);
  }

  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    // TODO: Implement listDysfunctionsService logic
    return new ListDysfunctionsOutputDto([]);
  }

  public function listInterventionsService(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    // TODO: Implement listInterventionsService logic
    return new ListInterventionsOutputDto([]);
  }

  public function listLeaksService(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    // TODO: Implement listLeaksService logic
    return new ListLeaksOutputDto([]);
  }

  public function myAccountService(MyAccountInputDto $inputDto): MyAccountOutputDto
  {
    // TODO: Implement myAccountService logic
    return new MyAccountOutputDto([]);
  }

  public function showEauReleveService(ShowEauReleveInputDto $inputDto): ShowEauReleveOutputDto
  {
    // TODO: Implement showEauReleveService logic
    return new ShowEauReleveOutputDto('');
  }

  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    // TODO: Implement showInterventionService logic
    return new ShowInterventionOutputDto('');
  }

  public function showNoteReleveService(ShowNoteReleveInputDto $inputDto): ShowNoteReleveOutputDto
  {
    // TODO: Implement showNoteReleveService logic
    return new ShowNoteReleveOutputDto('', '', '');
  }

  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto
  {
    // TODO: Implement showRepartReleveService logic
    return new ShowRepartReleveOutputDto('', '');
  }

  public function showService(ShowUseInputDto $inputDto): ShowOutputDto
  {
    // TODO: Implement showService logic
    return new ShowOutputDto([]);
  }

  public function simulateurService(SimulateurInputDto $inputDto): SimulateurOutputDto
  {
    // TODO: Implement simulateurService logic
    return new SimulateurOutputDto([]);
  }
}
