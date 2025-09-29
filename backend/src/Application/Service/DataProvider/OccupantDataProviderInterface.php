<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

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
use App\Application\Dto\Input\Occupant\ShowInputDto;
use App\Application\Dto\Output\Occupant\ShowOutputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Application\Dto\Output\Occupant\SimulateurOutputDto;
use App\Application\Dto\Input\Occupant\EditInputDto;
use App\Application\Dto\Output\Occupant\EditOutputDto;

interface OccupantDataProviderInterface
{

  public function alertesService(AlertesInputDto $inputDto): AlertesOutputDto;
  public function exportAnomaliesService(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto;
  public function exportDysfunctionsService(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto;
  public function exportInterventionsService(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto;
  public function exportLeaksService(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto;
  public function listAnomaliesService(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto;
  public function listDysfunctionsService(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto;
  public function listInterventionsService(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto;
  public function listLeaksService(ListLeaksInputDto $inputDto): ListLeaksOutputDto;
  public function myAccountService(MyAccountInputDto $inputDto): MyAccountOutputDto;
  public function showEauReleveService(ShowEauReleveInputDto $inputDto): ShowEauReleveOutputDto;
  public function showInterventionService(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto;
  public function showNoteReleveService(ShowNoteReleveInputDto $inputDto): ShowNoteReleveOutputDto;
  public function showRepartReleveService(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto;
  public function showService(ShowInputDto $inputDto): ShowOutputDto;
  public function simulateurService(SimulateurInputDto $inputDto): SimulateurOutputDto;
  public function editService(EditInputDto $inputDto): EditOutputDto;
}
