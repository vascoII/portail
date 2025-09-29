<?php

declare(strict_types=1);

namespace App\Application\Service\DataSource;

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
use App\Application\Dto\Input\Occupant\ShowInputDto;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Application\Dto\Input\Occupant\EditInputDto;

interface OccupantDataSourceInterface
{

  public function fetchAlertes(AlertesInputDto $inputDto): object;
  public function fetchExportAnomalies(ExportAnomaliesInputDto $inputDto): object;
  public function fetchExportDysfunctions(ExportDysfunctionsInputDto $inputDto): object;
  public function fetchExportInterventions(ExportInterventionsInputDto $inputDto): object;
  public function fetchExportLeaks(ExportLeaksInputDto $inputDto): object;
  public function fetchListAnomalies(ListAnomaliesInputDto $inputDto): object;
  public function fetchListDysfunctions(ListDysfunctionsInputDto $inputDto): object;
  public function fetchListInterventions(ListInterventionsInputDto $inputDto): object;
  public function fetchListLeaks(ListLeaksInputDto $inputDto): object;
  public function fetchMyAccount(MyAccountInputDto $inputDto): object;
  public function fetchShowEauReleve(ShowEauReleveInputDto $inputDto): object;
  public function fetchShowIntervention(ShowInterventionInputDto $inputDto): object;
  public function fetchShowNoteReleve(ShowNoteReleveInputDto $inputDto): object;
  public function fetchShowRepartReleve(ShowRepartReleveInputDto $inputDto): object;
  public function fetchShow(ShowInputDto $inputDto): object;
  public function fetchSimulateur(SimulateurInputDto $inputDto): object;
  public function fetchEdit(EditInputDto $inputDto): object;
}
